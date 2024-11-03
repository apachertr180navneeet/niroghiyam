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
    User_membership,
    Membership,
    Addiction
};




use Illuminate\Support\Facades\{
    Auth,
    Hash,
    Session
};
use Validator;

use URL;

use Carbon\Carbon;

class UserController extends ApiBaseController
{
    public function getuser(Request $request){

            $userid = $request->id;

            $user_detail = User::join('user_detail', 'user_detail.user_id', '=', 'users.id')->where('id', $userid)->first()->toArray();


            $allergy = explode(",",$user_detail['allergy']);
            $addiction = explode(",",$user_detail['addiction']);

            $List = "";

            foreach ($allergy as $value) {
                $allergy_list = Allergy::select('id','name')->where('id', $value)->get();
                foreach ($allergy_list as $id => $title) {
                    $success['UserAllergy'][] = $title->name;
                    $List = implode(',', $success['UserAllergy']);
                }
            }


            $addictionList = "";

            foreach ($addiction as $addictionvalue) {
                $addiction_list = Addiction::select('id','name')->where('id', $addictionvalue)->get();
                foreach ($addiction_list as $addictionid => $addictiontitle) {
                    $success['UserAddiction'][] = $addictiontitle->name;
                    $addictionList = implode(',', $success['UserAddiction']);
                }
            }


            if($user_detail['blood_group'] != ""){
                $bloodgroup_list = Blood_Group::where('id', $user_detail['blood_group'])->first();
            }else{
                $bloodgroup_list['name'] = "";
            }



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
                'UserImage' => ($user_detail['profile_image'] !="") ? ($user_detail['profile_image']) : (""),
            ];



            $success['residental_detail'] = [
                'address' => $user_detail['address'],
                'UserImage' => ($user_detail['profile_image'] !="") ? ($user_detail['profile_image']) : (""),
                'city' => $user_detail['city'],
                'state' => $user_detail['state'],
                'country' => $user_detail['country'],
            ];


            $success['medical_info'] = [
                'UserBloodGroup' => $bloodgroup_list['name'],
                'Uservecination' => $vecination,
                'UserAllergy' => $List,
                'UserAddiction' => $addictionList,
                'UserImage' => $user_detail['profile_image'],
            ];

            //$success['alerylist'] = $alerylist;

            return $this->sendResponse($success, 'User detail Get');
    }
    public function profileupdate(Request $request){

        $userid = $request->id;

        $baseUrl = url('/');

        if($request->file('profile_image') != ""){
            $file = $request->file('profile_image');
            $filename = time().'.'.$file->getClientOriginalExtension();



            // File upload location
            $location = 'uploads';

            $imageupload = $baseUrl.'/'.$location.'/'.$filename;

            // Upload file
            $file->move($location,$filename);


            $userdata = [
                'name' => $request->name,
                'phone_number' => $request->phone_number,
                'profile_image' => $imageupload,
            ];


            User::where('id', $userid)->update($userdata);
        }




        $userdata = [
            'name' => $request->name,
            'phone_number' => $request->phone_number
        ];

        if($request->allergy != 0){
            $alergyid = $request->allergy;
        }else{
            $datauser = [
                'name' => $request->allergy_text,
                'status' => '1'
           ];

           $id = Allergy::insertGetId($datauser);
        }

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
                'addiction' => $request->addiction,
            ];



            User_detail::where('user_id', $userid)->update($userdetaildata);

            $success['user_detail'] = User::join('user_detail', 'user_detail.user_id', '=', 'users.id')->where('id', $userid)->first();


            return $this->sendResponse($success, 'User detail updated');
    }
    public function usermembership(Request $request){
        $request->validate([
            'user_id' => 'required',
            'package_id' => 'required',
        ]);

        $checkuser =  User::where('id', $request->user_id)->first();

        if(!empty($checkuser)){
            $checkUsermembership =  User_membership::where('user_id', $request->user_id)->first();

            $membership_detail =  Membership::where('memberships.id', $request->package_id)->select('memberships.id AS membership_id','memberships.name AS membership_name','memberships.description','memberships.amount','membership_mode.name AS membership_mode_name')->join('membership_mode', 'membership_mode.id', '=', 'memberships.membership_mode')->first();

            $timestamp = time(); // Current Unix timestamp
            $random = uniqid(); // Generate a unique identifier
            $transaction_id = $timestamp . '_' . $random;

            $currentDateTime = Carbon::now();

            $start_date = $currentDateTime->format('Y-m-d H:i:s');

            if($membership_detail->membership_mode_name == "Monthly"){
                $end_date = $currentDateTime->addMonth()->format('Y-m-d H:i:s');
            }elseif($membership_detail->membership_mode_name == "Quarter"){
                $end_date = $currentDateTime->addMonth(3)->format('Y-m-d H:i:s');
            }elseif($membership_detail->membership_mode_name == "half yearly"){
                $end_date = $currentDateTime->addMonth(6)->format('Y-m-d H:i:s');
            }else{
                $end_date = $currentDateTime->addYear()->format('Y-m-d H:i:s');
            }

            if(!empty($checkUsermembership)){
                if($checkUsermembership->package_id != $request->package_id){
                    $datamembership = [
                        'user_id' => $request->user_id,
                        'package_id' => $request->package_id,
                        'transiction_id' => $transaction_id,
                        'amount' => $membership_detail->amount,
                        'start_date' => $start_date,
                        'end_date' => $end_date,
                   ];

                   User_membership::where('user_package_id', $checkUsermembership->user_package_id)->update($datamembership);

                   $datamembership = [
                    'user_id' => $request->user_id,
                    'package_id' => $request->package_id,
                    'transiction_id' => $transaction_id,
                    'amount' => $membership_detail->amount,
                    'start_date' => $start_date,
                    'end_date' => $end_date,
               ];

               User_membership::where('user_package_id', $checkUsermembership->user_package_id)->update($datamembership);


                   return response()->json(['message' => 'User Membership Updated successful'], 200);
                }else{
                    return response()->json(['error' => 'Same Membership Already Taken'], 401);
                }
            }else{
                $datamembership = [
                    'user_id' => $request->user_id,
                    'package_id' => $request->package_id,
                    'transiction_id' => $transaction_id,
                    'amount' => $membership_detail->amount,
                    'start_date' => $start_date,
                    'end_date' => $end_date,
               ];

               $usermembership = User_membership::create($datamembership);

               return response()->json(['message' => 'User Membership Taken successful'], 200);
            }
        }else{
            return response()->json(['error' => 'User Not Found'], 401);
        }
    }
    public function getusermembership(Request $request){
        $request->validate([
            'user_id' => 'required'
        ]);

        $checkUsermembership =  User_membership::where('user_packages.user_id', $request->user_id)->join('memberships', 'memberships.id', '=', 'user_packages.package_id')->first();
        if(!empty($checkUsermembership)){
            $success['usermembership'] = [
                'Membership Name' => $checkUsermembership->name,
                'Membership Amount' => $checkUsermembership->amount,
                'Membership Start Date' => $checkUsermembership->start_date,
                'Membership End Date' => $checkUsermembership->end_date,
            ];
            return $this->sendResponse($success, 'Membeship Detail');
        }else{
            return response()->json(['error' => 'Please purchase membership'], 401);
        }

    }
    public function getuserkyc(Request $request){

        $userid = $request->id;
        $user_kyc = User_kyc::where('user_id', $userid)->first();
        if(empty($user_kyc)){
            return $this->sendError('Kyc Detail Not found');
        }
        $user_detail = User::where('id', $userid)->first();
        $success['kyc_detail'] = [
            'kyc_front_image' => $user_kyc['kyc_front_image'] ?? '',
            'kyc_back_image' => $user_kyc['kyc_back_image'] ?? '',
            'kyc_detail' => $user_kyc['kyc_detail'] ?? '',
            'userkyc_status' => $user_detail['userkyc']?? ''
        ];

        return $this->sendResponse($success, 'User detail Get');
}
}
