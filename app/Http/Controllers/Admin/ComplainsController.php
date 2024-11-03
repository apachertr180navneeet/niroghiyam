<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;


use App\Models\{
    User,
    Compliances,
    CompliancesMessgae
};


use Exception;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\{
    Auth,
    Hash,
    Session
};

use Carbon\Carbon;

class ComplainsController extends Controller
{
    public function index(){
        if(Auth::check()){
            $user_data = auth()->user();


            $compliances_list = Compliances::select('complaint.id','complaint.replyed','complaint.titel','complaint.description','complaint.file','users.name')->join('users', 'complaint.userid', '=', 'users.id')->paginate(10);
            
            return view('admin.compliances.compliances_list',compact('user_data','compliances_list'))->with('i', (request()->input('page', 1) - 1) * 1);
        }

        return redirect("admin/login")->withSuccess('You are not allowed to access');
    }



    public function edit($id){
        if(Auth::check()){
            $user_data = auth()->user();

            $compliances = Compliances::where('id', $id)->first();


            $compliancesmessage = CompliancesMessgae::where('complaint_id', $id, 'message_user_type')->join('users', 'complaint_messgae.user_id', '=', 'users.id')->get()->toArray();

            // echo "<pre>";
            // print_r($compliancesmessage);
            // die;
            
            return view('admin.compliances.compliances_edit',compact('user_data','compliances', 'compliancesmessage'));
        }

        return redirect("admin/login")->withSuccess('You are not allowed to access');
    }


    public function reply(Request $request){
        $user_id = $request->user_id;
        $message = $request->message;
        $currentDate = Carbon::now();
        $messageat = $currentDate->format('d-m-Y H:i');
        $compliances_id = $request->compliances_id;

        $datacompliancesreply = [
            'complaint_id' => $compliances_id,
            'user_id' => $user_id,
            'message' => $message,
            'message_at' => $messageat
       ];
       $id = CompliancesMessgae::insertGetId($datacompliancesreply);
       return redirect()->route('admin.complains.edit', ['id' => $compliances_id])->with('success','Compliances Messgae created successfully.');
    }
}
