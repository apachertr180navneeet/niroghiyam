<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;


use App\Models\{
    User,
    User_membership,
    Membership
};


use Exception;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\{
    Auth,
    Hash,
    Session
};

use Carbon\Carbon;

class TransictionListController extends Controller
{
    public function index(){
        if(Auth::check()){
            $user_data = auth()->user();
            $payment_list = User_membership::select('user_packages.user_package_id','user_packages.user_id','user_packages.package_id','user_packages.transiction_id','user_packages.amount','user_packages.pay_status','user_packages.created_at','user_packages.pay_mode','user_packages.start_date','user_packages.end_date','users.name','memberships.name As memberships_name')->join('users', 'user_packages.user_id', '=', 'users.id')->join('memberships', 'user_packages.package_id', '=', 'memberships.id')->paginate(10);
            return view('admin.payment.payment_list',compact('user_data','payment_list'))->with('i', (request()->input('page', 1) - 1) * 1);
        }

        return redirect("admin/login")->withSuccess('You are not allowed to access');
    }
}
