<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;


use App\Http\Controllers\Api\ApiBaseController as ApiBaseController;

use App\Models\{
    User,
    User_detail,
    User_kyc
};




use Illuminate\Support\Facades\{
    Auth,
    Hash,
    Session
};
use Validator;

class UserController extends ApiBaseController
{
    public function getuser(Request $request){
            
            $userid = $request->id;

            $success['user_detail'] = User::join('user_detail', 'user_detail.user_id', '=', 'users.id')->where('id', $userid)->first();
            
            $img = $success['user_detail']->profile_image;
            
            $path = public_path().'/uploads/images/'.$img;
            
            $success['user_detail']['image'] = $path;
            
            return $this->sendResponse($success, 'User detail Get');
    }
    public function profileupdate(Request $request){
        $request->validate([
            'name' => 'required',
            'phone_number' => 'required',
            'dob' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'gender' => 'required',
            'blood_group' => 'required',
            'allergy' => 'required',
            'vecination' => 'required',

        ]);


        if($request->file('profile_image') != ""){
            $file = $request->file('profile_image');
            $filename = time().'.'.$file->getClientOriginalExtension();
            
            // File upload location
            $location = 'uploads';

            // Upload file
            $file->move($location,$filename);
        }else{
            $filename = "";
        }


        $userid = $request->id;

        $userdata = [
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'profile_image' => $filename,
        ];


        User::where('id', $userid)->update($userdata);

        
            $userdetaildata = [
                'address' => $request->address,
                'city' => $request->city,
                'state' => $request->state,
                'date_of_birth' => $request->dob,
                'gender' => $request->gender,
                'blood_group' => $request->blood_group,
                'allergy' => $request->allergy,
                'vecination' => $request->vecination,
            ];
    
    
            User_detail::where('user_id', $userid)->update($userdetaildata);

            $success['user_detail'] = User::join('user_detail', 'user_detail.user_id', '=', 'users.id')->where('id', $userid)->first();
            
            $img = $success['user_detail']->profile_image;
            
            $path = public_path().'/uploads/images/'.$img;
            
            $success['user_detail']['image'] = $path;
            
            return $this->sendResponse($success, 'User detail updated');
    }
}
