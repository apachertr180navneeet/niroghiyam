<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;


use App\Models\{
    User,
    Vaccination
};


use Exception;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\{
    Auth,
    Hash,
    Session
};

use Carbon\Carbon;

class VaccinationController extends Controller
{
    public function index(){
        if(Auth::check()){
            $user_data = auth()->user();


            $vaccination_list = Vaccination::select('vaccination.id','vaccination.user_id','vaccination.vaccination_date','vaccination.name AS vaccinationname','vaccination.vaccination_next_schedule','vaccination.type','vaccination.place','vaccination.remark','vaccination.vaccination_done','vaccination.status','users.name AS usersname')->join('users', 'vaccination.user_id', '=', 'users.id')->paginate(10);
            
            return view('admin.vaccination.vaccination_list',compact('user_data','vaccination_list'))->with('i', (request()->input('page', 1) - 1) * 1);
        }

        return redirect("admin/login")->withSuccess('You are not allowed to access');
    }
}
