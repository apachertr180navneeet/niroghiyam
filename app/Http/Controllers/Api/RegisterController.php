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
            'phone_number' => 'required',
            'dob' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'pincode' => 'required',
            'password' => 'required'
        ]);



        $datauser = [
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'type'=> '1',
            'username' => strtolower($request->email),
            'password' => Hash::make($request->password),
       ];

       $user = User::create($datauser);
       $id = $user->id;

       $datauserdetail = [
           'user_id' => $id    ,
           'address' => $request->address,
           'city' => $request->city,
           'state' => $request->state,
           'pincode' => $request->pincode,
           'date_of_birth' => $request->dob,
           'gender' => '1',
            'blood_group' => '1',
            'allergy' => '1',
            'vecination' => '1',
       ];

       $token =  $user->createToken('MyApp')->plainTextToken;

       $userdetail = User_detail::create($datauserdetail);

        return response()->json(['message' => 'Registration successful', 'user' => $user, 'userdetail' => $userdetail, 'token' => $token], 201);
    }


    public function login(Request $request)
    {
        $request->validate([
            'password' => 'required'
        ]);
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
            $user = Auth::user(); 
            $success['token'] =   $user->createToken('MyApp')->plainTextToken; 
            $success['name'] =  $user->name;
            $success['user_id'] =  $user->id;
            $otp = $success['otp'] = random_int(100000, 999999);

            User::where('email', $request->email)
                ->update(['otp' => $otp,'remember_token' => $success['token']]);
   
            return $this->sendResponse($success, 'User login successfully.');
        }elseif(Auth::attempt(['phone_number' => $request->mobile, 'password' => $request->password])){
            $user = Auth::user(); 
            $success['token'] =   $user->createToken('MyApp')->plainTextToken; 
            $success['name'] =  $user->name;
            $success['user_id'] =  $user->id;
            
            $success['otp'] = random_int(100000, 999999);


            User::where('phone_number', $request->mobile)
            ->update(['otp' => $success['otp'],'remember_token' => $success['token']]);

            return $this->sendResponse($success, 'User login successfully.');
        }else{ 
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        } 

        return response()->json(['error' => 'Invalid credentials'], 401);
    }



    public function checkotp(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'otp' => 'required'
        ]);

        
        if($request->email != ""){

            $user = User::where('email', $request->email)->where('remember_token',$request->token)->where('otp',$request->otp)->first();


            if(!empty($user)){
                $success['name'] =  $user->name;
                $success['user_id'] =  $user->id;
                return $this->sendResponse($success, 'Otp Matched');
            }else{
                $success['name'] =  "";
                return $this->sendResponse($success, 'Otp Not Matched');
            }

        }elseif($request->mobile != ""){
            $user = User::where('phone_number', $request->mobile)->where('remember_token',$request->token)->where('otp',$request->otp)->first();

            if(!empty($user)){
                $success['name'] =  $user->name;
                $success['user_id'] =  $user->id;
                return $this->sendResponse($success, 'Otp Matched');
            }else{
                $success['name'] =  "";
                return $this->sendResponse($success, 'Otp Matched');
            }

        }else{

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
                
                
                $file = $request->file('kyc_image');
                $filename = time().'.'.$file->getClientOriginalExtension();
                
                // File upload location
                $location = 'uploads';

                // Upload file
                $file->move($location,$filename);



                // echo $fileName = time().'.'.$request->kyc_image->extension(); die;
                // echo $path = $request->file->store(public_path('uploads/'), $fileName);
                // die;
                $datauser = [
                    'user_id' => $request->user_id,
                    'kyc_image' => $filename,
                    'kyc_detail' => $request->kyc_detail,
               ];
        
               $user = User_kyc::create($datauser);

               $success['user_id'] = $usertoken->id;
               $success['user_name'] = $usertoken->name;

               return $this->sendResponse($success, 'User kyc Updated');

            }else{
                $success['user'] = "User Not Found"; 
                return $this->sendResponse($success, 'User Not Found');
            }
            
        }else{
            $success['user'] = "Pls Add correct token"; 
            return $this->sendResponse($success, 'Token Dosn,t mactched');
        }
    }

}
