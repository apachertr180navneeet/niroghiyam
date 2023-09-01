<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;


use App\Models\{
    User,
    User_membership,
    Logs
};


use Exception;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\{
    Auth,
    Hash,
    Session
};

use Carbon\Carbon;

class LogsController extends Controller
{
    public function index(){
        if(Auth::check()){
            $user_data = auth()->user();
            $logs_list = Logs::select('logs.id','logs.user_id','logs.message','users.name')->join('users', 'logs.user_id', '=', 'users.id')->paginate(10);
            return view('admin.logs.logs_list',compact('user_data','logs_list'))->with('i', (request()->input('page', 1) - 1) * 1);
        }

        return redirect("admin/login")->withSuccess('You are not allowed to access');
    }
}
