<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Controllers\Api\ApiBaseController as ApiBaseController;

use App\Models\{
    User,
    User_detail
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
            $otp = $success['otp'] = random_int(100000, 999999);

            User::where('email', $request->email)
                ->update(['otp' => $otp,'remember_token' => $success['token']]);
   
            return $this->sendResponse($success, 'User login successfully.');
        }elseif(Auth::attempt(['phone_number' => $request->mobile, 'password' => $request->password])){
            $user = Auth::user(); 
            $success['token'] =   $user->createToken('MyApp')->plainTextToken; 
            $success['name'] =  $user->name;
            
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
                return $this->sendResponse($success, 'Otp Matched');
            }else{
                $success['name'] =  "";
                return $this->sendResponse($success, 'Otp Not Matched');
            }

        }elseif($request->mobile != ""){
            $user = User::where('phone_number', $request->mobile)->where('remember_token',$request->token)->where('otp',$request->otp)->first();

            if(!empty($user)){
                $success['name'] =  $user->name;
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

            User::where('email', $request->email)
                ->update(['otp' => $otp]);
   
            return $this->sendResponse($success, 'Resend Otp.');

        }elseif($request->mobile != ""){
            $user = User::where('phone_number', $request->mobile)->first();

            $success['otp'] = random_int(100000, 999999);


            User::where('phone_number', $request->mobile)
            ->update(['otp' => $success['otp']]);

            return $this->sendResponse($success, 'Resend Otp.');

        }else{
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

    }

}
