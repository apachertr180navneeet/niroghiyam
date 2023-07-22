<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;


use App\Http\Controllers\Api\ApiBaseController as ApiBaseController;

use App\Models\{
    User,
    User_detail,
    User_kyc,
    Blood_Group,
    Allergy,
};




use Illuminate\Support\Facades\{
    Auth,
    Hash,
    Session
};
use Validator;

use URL;

class UserController extends ApiBaseController
{
    public function getuser(Request $request){
            
            $userid = $request->id;

            $user_detail = User::join('user_detail', 'user_detail.user_id', '=', 'users.id')->where('id', $userid)->first()->toArray();


            $allergy = explode(",",$user_detail['allergy']);

            $List = "";

            foreach ($allergy as $value) {
                $allergy_list = Allergy::select('id','name')->where('id', $value)->get();
                foreach ($allergy_list as $id => $title) {
                    $success['UserAllergy'][] = $title->name;
                    $List = implode(',', $success['UserAllergy']);
                }
            }


            $bloodgroup_list = Blood_Group::where('id', $user_detail['blood_group'])->first()->toArray();

            

            if($user_detail['gender'] == '1'){
                $gender = 'Male';
            }elseif($user_detail['gender'] == '2'){
                $gender = 'Female';
            }else{
                $gender = 'Other';
            }


            if($user_detail['vecination'] == '1'){
                $vecination = 'Yes';
            }else{
                $vecination = 'No';
            }

            $success['porsnal_detail'] = [
                'UserId' => $user_detail['id'],
                'UserFullName' => $user_detail['name'],
                'UserEmail' => $user_detail['email'],
                'UserPhoneNumber' => $user_detail['phone_number'],
                'UserDob' => $user_detail['date_of_birth'],
                'UserGender' => $gender,
                'UserBloodGroup' => $bloodgroup_list['name'],
                'Uservecination' => $vecination,
                'UserAllergy' => $List,
                'UserImage' => $user_detail['profile_image'],
            ];



            $success['residental_detail'] = [
                'address' => $user_detail['address'],
                'UserImage' => $user_detail['profile_image'],
                'city' => $user_detail['city'],
                'state' => $user_detail['state'],
                'country' => $user_detail['country'],
            ];


            $success['medical_info'] = [
                'UserBloodGroup' => $bloodgroup_list['name'],
                'Uservecination' => $vecination,
                'UserAllergy' => $List,
                'UserImage' => $user_detail['profile_image'],
            ];

            //$success['alerylist'] = $alerylist;
            
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

        $baseUrl = url('/');
        
        if($request->file('profile_image') != ""){
            $file = $request->file('profile_image');
            $filename = time().'.'.$file->getClientOriginalExtension();
            

            
            // File upload location
            $location = 'uploads';

            $imageupload = $baseUrl.'/'.$location.'/'.$filename;

            // Upload file
            $file->move($location,$filename);
        }else{
            $imageupload = "";
        }


        $userid = $request->id;

        $userdata = [
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'profile_image' => $imageupload,
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
            

            
            return $this->sendResponse($success, 'User detail updated');
    }
}
