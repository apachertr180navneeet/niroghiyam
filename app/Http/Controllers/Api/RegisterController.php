<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Controllers\API\ApiBaseController as ApiBaseController;

use App\Models\{
    User
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
        echo "hello"; die;
        // $validator = Validator::make($request->all(), [
        //     'name' => 'required',
        //     'email' => 'required|email',
        //     'password' => 'required',
        //     'c_password' => 'required|same:password',
        // ]);
   
        // if($validator->fails()){
        //     return $this->sendError('Validation Error.', $validator->errors());       
        // }
   
        // $input = $request->all();
        // $input['password'] = bcrypt($input['password']);
        // $user = User::create($input);
        // $success['token'] =  $user->createToken('MyApp')->plainTextToken;
        // $success['name'] =  $user->name;
   
        // return $this->sendResponse($success, 'User register successfully.');
    }
}
