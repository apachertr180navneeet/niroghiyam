<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\{
    User,
    Membership
};


use Exception;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\{
    Auth,
    Hash,
    Session
};

class MembershipController extends Controller
{
    public function index(){
        if(Auth::check()){
            $user_data = auth()->user();

            $memebership_list = Membership::paginate(10);
            
            return view('admin.memebership.memebership_list',compact('user_data','memebership_list'))->with('i', (request()->input('page', 1) - 1) * 1);
        }

        return redirect("admin/login")->withSuccess('You are not allowed to access');
    }




    public function create(){
        if(Auth::check()){
            $user_data = auth()->user();
            
            return view('admin.memebership.memebership_add',compact('user_data'));
        }

        return redirect("admin/login")->withSuccess('You are not allowed to access');
    }


    public function store(Request $request){

        $validatedData = $request->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
        ]);

        

        $datauser = [
             'name' => $request->name,
             'description' => $request->description,
             'amount' => $request->price,
        ];

        $id = Membership::insertGetId($datauser);


        return redirect()->route('admin.membership.list')->with('success','Membership created successfully.');

    }



    public function edit($id){
        if(Auth::check()){
            $user_data = auth()->user();
            $memebership = Membership::where('id', $id)->first();
            
            return view('admin.memebership.memebership_edit',compact('user_data','memebership'));
        }

        return redirect("admin/login")->withSuccess('You are not allowed to access');
    }
    
    
    public function update(Request $request){
        $validatedData = $request->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
        ]);

        $id = $request->id;
        $datauser = [
            'name' => $request->name,
            'description' => $request->description,
            'amount' => $request->price,
       ];

        Membership::where('id', $id)->update($datauser);


        return redirect()->route('admin.membership.list')->with('success','Membership update successfully.');
    }




    public function delete($id)
    {
        $deleted = Membership::where('id', $id)->delete();
        return response()->json(['success'=>'Membership Deleted Successfully!']);
    }


    public function status(Request $request){
        
        $id = $request->id;
        $datauser = [
             'status' => $request->status,
        ];

        Membership::where('id', $id)->update($datauser);


        return response()->json(['success'=>'Membership Status Changes Successfully!']);
    }   
}
