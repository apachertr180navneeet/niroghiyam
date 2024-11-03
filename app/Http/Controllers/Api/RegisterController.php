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
    Logs,
    User_membership
};


use Kreait\Laravel\Firebase\Facades\Firebase;

use Illuminate\Support\Facades\{
    Auth,
    Hash,
    Session,
    Mail
};
use Validator;
use DB;
use Carbon\Carbon;

use App\Mail\ForgotPasswordMail;

class RegisterController extends ApiBaseController
{
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone_number' => 'required|unique:users',
            'dob' => 'required',
            'address' => 'required',
            'city' => 'required',
            'country' => 'required',
            'state' => 'required',
            'pincode' => 'required',
            'password' => 'required'
        ]);

                $otp = random_int(100000, 999999);
                $reportotp = random_int(1000, 9999); 
                // $url = "http://msg.icloudsms.com/rest/services/sendSMS/sendGroupSms?AUTH_KEY=e90dedc2d77274aee9dc1144e489811&message=Dear%20Member%2C%20use." . $otp . "%20as%20OTP%20to%20verify%20your%20mobile%20number.&senderId=CSHBRO&routeId=1&mobileNos=" . $request->phone_number . "&smsContentType=english";

                // $curl = curl_init();

                // curl_setopt_array($curl, array(
                // CURLOPT_URL => $url,
                // CURLOPT_RETURNTRANSFER => true,
                // CURLOPT_ENCODING => '',
                // CURLOPT_MAXREDIRS => 10,
                // CURLOPT_TIMEOUT => 0,
                // CURLOPT_FOLLOWLOCATION => true,
                // CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                // CURLOPT_CUSTOMREQUEST => 'GET',
                // CURLOPT_HTTPHEADER => array(
                //     'Cookie: JSESSIONID=2609E0E11FC7BE8BB1840EB3528992DC.node3'
                // ),
                // ));

                // $response = curl_exec($curl);

                // curl_close($curl);
                $userslug = strtolower($request->name . $request->phone_number);
                $foo = preg_replace('/\s+/', ' ', $userslug);
                // Replace non-alphanumeric characters with hyphens
                $slug = preg_replace('/[^a-z0-9]+/', '-', $foo);
                
                // Remove leading and trailing hyphens
                $slug = trim($slug, '-');
                
                // Replace multiple consecutive hyphens with a single hyphen
                $slug = preg_replace('/-+/', '-', $slug);
        $datauser = [
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'username' => strtolower($request->email),
            'password' => Hash::make($request->password),
            'otp' => $otp,
            'report_otp' => $reportotp,
            'urlslug' => $slug

        ];

        
        $user = User::create($datauser);
        $id = $user->id;
        $token =  $user->createToken('MyApp')->plainTextToken;

        $datauserdetail = [
            'user_id' => $id    ,
            'address' => $request->address,
            'city' => $request->city,
            'country' => $request->country,
            'state' => $request->state,
            'pincode' => $request->pincode,
            'date_of_birth' => $request->dob,
        ];
        $userdetail = User_detail::create($datauserdetail);

        $dataLogs = [
            'user_id' => $id,
            'message' => $request->name.",You Have registered in Niroghyam"
        ];

        $notification = Logs::create($dataLogs);

        $notificationData['user_id'] = $notification->user_id;
        $notificationData['message'] = $notification->message; 

        return response()->json(['message' => 'Registration successful', 'user' => $user, 'userdetail' => $userdetail, 'token' => $token, 'Notification' => $notificationData], 200);
    }


    public function login(Request $request)
    {
        $username = $request->username;
       $password = Hash::make($request->password);
        
        if($username == ""){
            return response()->json(['error' => 'Invalid credentials'], 401);
        }else{
            $usermobile =  User::where('phone_number', $username)->orwhere('email', $username)->first();
            //dd($usermobile->id);
            if (!$usermobile || !Hash::check($request->password, $usermobile->password)) {
                return response()->json(['error' => 'Invalid credentials'], 401);
            }
            $checkUsermembership =  User_membership::where('user_id', $usermobile->id)->first();
            if(!empty($checkUsermembership)){
                $success['free_trial'] = '0';
            }else{
                $createdDate = Carbon::parse($usermobile->created_at);
                $currentDate = Carbon::now();
                $daysDifference = $createdDate->diffInDays($currentDate);
                if ($daysDifference < 200) {
                    $success['free_trial'] = '0';
                } else {
                    $success['free_trial'] = '1';
                }
            }
           
            if($usermobile){
                $length = 32; // Length of the token in bytes

                $randomBytes = random_bytes($length);
                $token = $success['token'] = base64_encode($randomBytes);
                $success['otp'] = random_int(100000, 999999); 
                $success['id'] = $usermobile->id;
                $success['userkyc'] = $usermobile->userkyc;
        
                $url = "http://msg.icloudsms.com/rest/services/sendSMS/sendGroupSms?AUTH_KEY=e90dedc2d77274aee9dc1144e489811&message=Dear%20Member%2C%20use." . $success['otp'] . "%20as%20OTP%20to%20verify%20your%20mobile%20number.&senderId=CSHBRO&routeId=1&mobileNos=" . $usermobile->phone_number . "&smsContentType=english";

                $curl = curl_init();

                curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    'Cookie: JSESSIONID=2609E0E11FC7BE8BB1840EB3528992DC.node3'
                ),
                ));

                $response = curl_exec($curl);

                curl_close($curl);
                

                $user = User::where('email', $username)->orwhere('phone_number', $username)
                ->update(['otp' => $success['otp'],'remember_token' => $token]);

                $dataLogs = [
                    'user_id' => $usermobile->id,
                    'message' => $usermobile->name.",You have login in Niroghyam"
                ];
        
                $notification = Logs::create($dataLogs);
        
                $notificationData['user_id'] = $notification->user_id;
                $notificationData['message'] = $notification->message;
                

                return $this->sendResponse($success,$notificationData, 'User login successfully.');
            }else{
                return response()->json(['error' => 'Invalid credentials'], 401);   
            }
        }
    }



    public function checkotp(Request $request)
    {
        $request->validate([
            'userid' => 'required',
            'otp' => 'required'
        ]);

        $List = "";

        $user = User::where('id', $request->userid)->where('remember_token',$request->token)->where('otp',$request->otp)->first();


        


        if(!empty($user)){
            $success['name'] =  $user->name;
            $success['user_id'] =  $user->id;
            $user_detail = User::join('user_detail', 'user_detail.user_id', '=', 'users.id')->where('id', $user->id)->first();

            if(!empty($user_detail['allergy'])){
                $allergy = explode(",",$user_detail['allergy']);

                foreach ($allergy as $value) {
                    $allergy_list = Allergy::select('id','name')->where('id', $value)->get();
                    foreach ($allergy_list as $id => $title) {
                        $success['UserAllergy'][] = $title->name;
                        $List = implode(',', $success['UserAllergy']);
                    }
                }
            }else{
                $List = "";
            }



            $bloodgroup_list = Blood_Group::where('id', $user_detail['blood_group'])->first();
            

            

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

            if(!empty($bloodgroup_list)){
                $UserBloodGroup=$bloodgroup_list['name'];
            }else{
                $UserBloodGroup="";
            }

            if(!empty($bloodgroup_list)){
                $profile_image=$user_detail['profile_image'];
            }else{
                $profile_image="";
            }

            $success['porsnal_detail'] = [
                'UserId' => $user_detail['id'],
                'UserFullName' => $user_detail['name'],
                'UserEmail' => $user_detail['email'],
                'UserPhoneNumber' => $user_detail['phone_number'],
                'UserDob' => $user_detail['date_of_birth'],
                'UserGender' => $gender,
                'UserBloodGroup'=>$UserBloodGroup,
                'Uservecination' => $vecination,
                'UserAllergy' => $List,
                'UserImage' => $profile_image,
            ];



            $success['residental_detail'] = [
                'address' => $user_detail['address'],
                'UserImage' => $profile_image,
                'city' => $user_detail['city'],
                'state' => $user_detail['state'],
                'country' => $user_detail['country'],
            ];


            $success['medical_info'] = [
                'UserBloodGroup' => $UserBloodGroup,
                'Uservecination' => $vecination,
                'UserAllergy' => $List,
                'UserImage' => $profile_image,
            ];
            return $this->sendResponse($success, 'Otp Matched');
        }else{
            $success['name'] =  "";
            return $this->sendResponse($success, 'Otp Not Matched');
        }
         

        return response()->json(['error' => 'Invalid credentials'], 401);
    }



    public function resendotp(Request $request)
    {
        if($request->email != ""){


            $user = User::where('email', $request->email)->first();


            $otp = $success['otp'] = random_int(100000, 999999);
            $success['user_id'] =  $user->id;
            $success['user_name'] =  $user->name;

            User::where('email', $request->email)
                ->update(['otp' => $otp]);
   
            return $this->sendResponse($success, 'Resend Otp.');

        }elseif($request->mobile != ""){
            $user = User::where('phone_number', $request->mobile)->first();

            $success['otp'] = random_int(100000, 999999);
            $success['user_id'] =  $user->id;
            $success['user_name'] =  $user->name;


            User::where('phone_number', $request->mobile)
            ->update(['otp' => $success['otp']]);

            return $this->sendResponse($success, 'Resend Otp.');

        }else{
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

    }



    public function userkyc(Request $request){
        $request->validate([
            'token' => 'required',
            'user_id' => 'required',
            'kyc_detail' => 'required',
        ]);
        $usertoken = User::where('remember_token', $request->token)->first();
        if(!empty($usertoken)){
            if($usertoken->id == $request->user_id){

                $userkyc = User_kyc::where('user_id', $request->user_id)->first();

                if(!empty($userkyc)){
                    $baseUrl = url('/');
                    // File upload location
                    $location = 'uploads';
                    $datauser = [
                        'user_id' => $request->user_id,
                        'kyc_detail' => $request->kyc_detail,
                    ];
                    if(!empty($request->file('front_image'))){
                        $front_image = $request->file('front_image');
                        $front_imagename = time().'front_image.'.$front_image->getClientOriginalExtension();
    
                        $front_images = $baseUrl.'/'.$location.'/'.$front_imagename;
    
                        // Upload file
                        $front_image->move($location,$front_imagename);
                        $datauser['kyc_front_image'] = $front_images;

                    }


                    if(!empty($request->file('back_image'))){
                        $back_image = $request->file('back_image');

                        $back_imagename = time().'back_image.'.$back_image->getClientOriginalExtension();
    
                        $back_images = $baseUrl.'/'.$location.'/'.$back_imagename;
                        
    
                        // Upload file
                        $back_image->move($location,$back_imagename);

                        $datauser['kyc_back_image'] = $back_images;

                    }



                    
                

                    $user =User_kyc::where('user_id', $request->user_id)
                        ->update($datauser);

                        $success['user_id'] = $usertoken->id;
                        $success['user_name'] = $usertoken->name;
    
                        $user =User::where('id', $request->user_id)
                            ->update(['userkyc' => '1']);
    
                        return $this->sendResponse($success, 'User kyc Updated');
                }else{
                    $baseUrl = url('/');
                    $datauser = [
                        'user_id' => $request->user_id,
                        'kyc_detail' => $request->kyc_detail,
                    ];
                    // File upload location
                    $location = 'uploads';
                    
                    if(!empty($request->file('front_image'))){
                        $front_image = $request->file('front_image');
                        $front_imagename = time().'front_image.'.$front_image->getClientOriginalExtension();
    
                        $front_images = $baseUrl.'/'.$location.'/'.$front_imagename;
    
                        // Upload file
                        $front_image->move($location,$front_imagename);
                        $datauser['kyc_front_image'] = $front_images;

                    }


                    if(!empty($request->file('back_image'))){
                        $back_image = $request->file('back_image');

                        $back_imagename = time().'back_image.'.$back_image->getClientOriginalExtension();
    
                        $back_images = $baseUrl.'/'.$location.'/'.$back_imagename;
                        
    
                        // Upload file
                        $back_image->move($location,$back_imagename);

                        $datauser['kyc_back_image'] = $back_images;

                    }



                
                    $user = User_kyc::create($datauser);

                    $success['user_id'] = $usertoken->id;
                    $success['user_name'] = $usertoken->name;

                    $user =User::where('id', $request->user_id)
                        ->update(['userkyc' => '1']);

                    return $this->sendResponse($success, 'User kyc added successfully');
                }

            }else{
                $success['user'] = "User Not Found"; 
                return $this->sendResponse($success, 'User Not Found');
            }
            
        }else{
            $success['user'] = "Pls Add correct token"; 
            return $this->sendResponse($success, 'Token Dosn,t mactched');
        }
    }


    public function forgotPassword(Request $request){
    
        $username = $request->username;
        $user = User::where('email',$username)->first();
        if(empty($user)){
            return response()->json(['error' => 'user not found'], 200);
        }
        $success['otp'] = $code = rand(100000,999999);
        $user->otp = $code;
        $user->password = Hash::make($code);
        $user->save();
        $name = $user->first_name.' '.$user->last_name;
        $mail = Mail::to($username)->send(new ForgotPasswordMail($user, $code));
        try {
            return $this->sendResponse($success, 'A six digits password reset code is sent to your email.Please check your email');
        } catch (\Throwable $th) {
            return response()->json(['error' => $th], 200);
        }
    }


    public function changePassword(Request $request){
    
        $id = $request->id;
        $code = $request->code;
        $password = $request->password;
        if($request->type == '1'){
            $success['user'] = $user = User::where('id',$id)->first();
        }else{
            $success['user'] = $user = User::where('otp',$code)->first();

        }
        
        if(!empty($user)){
            $userdata = [
                'password' => Hash::make($request->password),
                'otp' => "",
            ];
    
    
            User::where('id', $user->id)->update($userdata);
    
            return $this->sendResponse($success, 'password Changed');
        }else{
            return response()->json(['error' => 'User Not Found'], 200);
        }
        
    }


    public function EmergencyMssage(Request $request){
    
        //$emergency_mobile_number = $request->emergency_mobile_number;
        $userid = $request->userid;
        $user = User::where('id',$userid)->first();
        $records = DB::table('emergancy_contact')->where('userid', $userid)->get();
        foreach ($records as $key => $value) {
            
            $emergency_mobile_number = $value->emergancy_contact_mobile;
            $single = $user->report_otp .'Link:-https://niroghyam.com/public/report/'.$user->urlslug;
            //$url = "http://msg.icloudsms.com/rest/services/sendSMS/sendGroupSms?AUTH_KEY=e90dedc2d77274aee9dc1144e489811&message=Your%20loved%20one%20is%20in%20trouble.%20person%20will%20contact%20you.%20Give%20this%20otp%20".$user->report_otp.".%20Link%20is%20%3Chttps%3A%2F%2Fniroghyam.com%2Fpublic%2Freport%2F".$user->urlslug."%3E&senderId=CSHBRO&routeId=1&mobileNos=".$emergency_mobile_number."&smsContentType=english";
            //$url = "http://msg.icloudsms.com/rest/services/sendSMS/sendGroupSms?AUTH_KEY=e90dedc2d77274aee9dc1144e489811&message=Dear%20Member%2C%20use." . $single . "%20as%20OTP%20to%20verify%20your%20mobile%20number.&senderId=CSHBRO&routeId=1&mobileNos=" . $emergency_mobile_number . "&smsContentType=english";
           // $url = "http://msg.icloudsms.com/rest/services/sendSMS/sendGroupSms?AUTH_KEY=e90dedc2d77274aee9dc1144e489811&message=Dear%20Member%2C%20use." . $single . "%20as%20OTP%20to%20verify%20your%20mobile%20number.&senderId=CSHBRO&routeId=1&mobileNos=7821810600&smsContentType=english";
            $curl = curl_init();
        
            curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Cache-Control: no-cache'
            ),
            ));
            
            $response = curl_exec($curl);
        //print_r($response);
            curl_close($curl);
        }

        
        
        $success['response'] = '1';        

        return $this->sendResponse($success, 'message send');
    }

}
