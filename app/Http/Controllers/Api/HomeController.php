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
    Setting
};




use Illuminate\Support\Facades\{
    Auth,
    Hash,
    Session
};
use Validator;

use URL;

class HomeController extends ApiBaseController
{
    public function home_screen(Request $request){
            
            $userid = $request->userid;

            $user_detail = User::join('user_detail', 'user_detail.user_id', '=', 'users.id')->where('id', $userid)->first();
            
            $List = "";
            $allergy = explode(",",$user_detail['allergy']);

            foreach ($allergy as $value) {
                $allergy_list = Allergy::select('id','name')->where('id', $value)->get();
                foreach ($allergy_list as $id => $title) {
                    $UserAllergy[] = $title->name;
                    $List = implode(',', $UserAllergy);
                }
            }

            if($user_detail['blood_group'] != ""){
                $bloodgroup_list = Blood_Group::where('id', $user_detail['blood_group'])->first();
            }else{
                $bloodgroup_list['name'] = "";
            }


            if($user_detail['vecination'] == '1'){
                $vecination = 'Yes';
            }else{
                $vecination = 'No';
            }

            $success['homescreen'] = [
                'Fullname' => $user_detail['name'],
                'Mobile' => $user_detail['phone_number'],
                'UserBloodGroup' => $bloodgroup_list['name'],
                'Uservecination' => $vecination,
                'UserAllergy' => $List,
                'UserImage' => ($user_detail['profile_image'] !="") ? ($user_detail['profile_image']) : (""),
            ];

            //$success['alerylist'] = $alerylist;
            
            return $this->sendResponse($success, 'Home Screen Data');
    }

    public function intro_vedio(Request $request){
        $setting = Setting::where('id', '1')->first();
        $success['setiing_data'] = [
            'Vedio' => ($setting['vedio'] !="") ? ($setting['vedio']) : (""),
        ];
        
        return $this->sendResponse($success, 'Setting Data');
    }
}
