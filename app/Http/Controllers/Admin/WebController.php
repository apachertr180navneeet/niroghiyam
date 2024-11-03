<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\{
    User,
    User_detail,
    User_kyc
};
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{
    Auth,
    Hash,
    Session
};

use Carbon\Carbon;

class WebController extends Controller

{

    public function term_and_condition(){
        return view('website.term_and_condition');
    }


    public function about(){
        return view('website.about');
    }

    public function privacy_policy(){
        return view('website.privacy_policy');
    }

    public function delete_user_account(){
        return view('website.delete_user_account');
    }


    public function delete_user(Request $request){
        $validatedData = $request->validate([
            'email' => 'required',
        ]);
        $pass= Hash::make($request->password);
        $userdetail = User::where('email', $request->email)->first();
        $userid = $userdetail->id;
        User_detail::where('user_id', '=', $userid)->delete();
        User_kyc::where('user_id', '=', $userid)->delete();
        User::where('id', '=', $userid)->delete();


        return redirect()->back()->with('success', 'User Account Deleted Successfully');
    }

}

