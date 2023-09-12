<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\{
    User,
    Setting
};


use Exception;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\{
    Auth,
    Hash,
    Session
};




class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function dashboard()
    {
        if(Auth::check()){
            $user_data = auth()->user();

            $userCount = User::where('type', '1')->count();
            $userCountActive = User::where('type', '1')->where('status', '1')->count();
            $userCountInActive = User::where('type', '1')->where('status', '0')->count();
            
            return view('admin.dashboard.dashboard',compact('user_data','userCount','userCountActive','userCountInActive'));
        }

        return redirect("admin/login")->withSuccess('You are not allowed to access');
    }

    public function setting(){
        if(Auth::check()){
            $user_data = auth()->user();

            $settingdata = Setting::where('id', '1')->get();
            
            return view('admin.setiing.setting_edit',compact('user_data','settingdata'));
        }

        return redirect("admin/login")->withSuccess('You are not allowed to access');
    }

    public function logout() {
        Session::flush();
        Auth::logout();

        return Redirect('admin/login');
    }
}
