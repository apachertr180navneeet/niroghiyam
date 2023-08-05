<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\{
    User,
    User_detail,
    User_kyc,
    Allergy,
    Blood_Group
};


use Exception;
use DB;
use Illuminate\Http\Request;





use Illuminate\Support\Facades\{
    Auth,
    Hash,
    Session,
    Storage
};

class UserController extends Controller
{
    public function index(){
        if(Auth::check()){
            $user_data = auth()->user();

            $user_list = User::where('type', '1')->select('users.id','users.status','users.name','users.email','users.phone_number','user_detail.city','user_detail.state')->join('user_detail', 'users.id', '=', 'user_detail.user_id')->paginate(10);
            
            return view('admin.customer.customer_list',compact('user_data','user_list'))->with('i', (request()->input('page', 1) - 1) * 1);
        }

        return redirect("admin/login")->withSuccess('You are not allowed to access');
    }




    public function create(){
        if(Auth::check()){
            $user_data = auth()->user();

            $allergy_list = Allergy::where('status', '1')->get();

            $bg_list = Blood_Group::where('status', '1')->get();
            
            return view('admin.customer.customer_add',compact('user_data','bg_list','allergy_list'));
        }

        return redirect("admin/login")->withSuccess('You are not allowed to access');
    }


    public function store(Request $request){

        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone_number' => 'required|numeric|min:0|max:10',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required'
        ]);

        $datauser = [
             'name' => $request->name,
             'email' => $request->email,
             'phone_number' => $request->phone_number,
             'password' => Hash::make('12345678'),
             'type'=> '1',
             'username' => strtolower($request->email),
        ];

        $id = User::insertGetId($datauser);

        $datauserdetail = [
            'user_id' => $id    ,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'pincode' => $request->pincode,
            'gender' => $request->gender,
            'blood_group' => $request->bloodgroup,
            'allergy' => $request->allergy,
            'vecination' => $request->vecination,
            'date_of_birth' => $request->dob,
        ];

        User_detail::create($datauserdetail);


        $datauserkyc = [
            'user_id' => $id    ,
            'kyc_detail' => $request->kyc_number,
        ];

        User_kyc::create($datauserkyc);


        return redirect()->route('admin.customer.list')->with('success','User created successfully.');

    }


    public function view($id){
        if(Auth::check()){
            $user_data = auth()->user();

            $user_detail = User::where('id', $id)->join('user_detail', 'users.id', '=', 'user_detail.user_id')->join('user_kyc', 'users.id', '=', 'user_kyc.user_id')->first();

            return view('admin.customer.customer_detail',compact('user_data','user_detail'));
        }

        return redirect("admin/login")->withSuccess('You are not allowed to access');
    }
       
    public function edit($id){
        if(Auth::check()){
            $user_data = auth()->user();
            $user = User::where('id', $id)->join('user_detail', 'users.id', '=', 'user_detail.user_id')->join('user_kyc', 'users.id', '=', 'user_kyc.user_id')->first();

            $allergy_list = Allergy::where('status', '1')->get();

            $bg_list = Blood_Group::where('status', '1')->get();
            
            return view('admin.customer.customer_edit',compact('user_data','user','bg_list','allergy_list'));
        }

        return redirect("admin/login")->withSuccess('You are not allowed to access');
    }
        
    public function update(Request $request){
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone_number' => 'required|numeric|min:0|max:10',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required'
        ]);

        $id = $request->id;
        $datauser = [
             'name' => $request->name,
             'email' => $request->email,
             'phone_number' => $request->phone_number,
        ];

        User::where('id', $id)->update($datauser);

        $datauserdetail = [
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'pincode' => $request->pincode,
            'gender' => $request->gender,
            'blood_group' => $request->bloodgroup,
            'allergy' => $request->allergy,
            'vecination' => $request->vecination,
            'date_of_birth' => $request->dob,
        ];

        User_detail::where('user_id', $id)->update($datauserdetail);


        $datauserkyc = [
            'kyc_detail' => $request->kyc_number,
        ];

        User_kyc::where('user_id', $id)->update($datauserkyc);


        return redirect()->route('admin.customer.list')->with('success','User created successfully.');
    }

    public function delete($id)
    {
        $deleteduserdetail = User_detail::where('user_id', $id)->delete();

        $deleteduserkyc = User_kyc::where('user_id', $id)->delete();

        $deleted = User::where('id', $id)->delete();
        return response()->json(['success'=>'User Deleted Successfully!']);
    }
    
    public function status(Request $request){
        
        $id = $request->id;
        $datauser = [
             'status' => $request->status,
        ];

        
        User::where('id', $id)->update($datauser);


        return response()->json(['success'=>'Allergy Status Changes Successfully!']);
    }



    public function document($id){
        if(Auth::check()){
            $user_data = auth()->user();

            $user_detail = User::where('id', $id)->join('user_detail', 'users.id', '=', 'user_detail.user_id')->join('user_kyc', 'users.id', '=', 'user_kyc.user_id')->first();

            return view('admin.customer.customer_doc_report',compact('user_data','user_detail'));
        }

        return redirect("admin/login")->withSuccess('You are not allowed to access');
    }
}
