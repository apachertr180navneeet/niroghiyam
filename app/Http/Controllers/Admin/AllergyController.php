<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\{
    User,
    Allergy
};


use Exception;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\{
    Auth,
    Hash,
    Session
};

class AllergyController extends Controller
{
    public function index(){
        if(Auth::check()){
            $user_data = auth()->user();

            $allergy_list = Allergy::paginate(10);
            
            return view('admin.allergy.allergy_list',compact('user_data','allergy_list'))->with('i', (request()->input('page', 1) - 1) * 1);
        }

        return redirect("admin/login")->withSuccess('You are not allowed to access');
    }




    public function create(){
        if(Auth::check()){
            $user_data = auth()->user();
            
            return view('admin.allergy.allergy_add',compact('user_data'));
        }

        return redirect("admin/login")->withSuccess('You are not allowed to access');
    }


    public function store(Request $request){

        $validatedData = $request->validate([
            'name' => 'required',
        ]);

        

        $datauser = [
             'name' => $request->name,
        ];

        $id = Allergy::insertGetId($datauser);


        return redirect()->route('admin.allergy.list')->with('success','Allergy created successfully.');

    }



    public function edit($id){
        if(Auth::check()){
            $user_data = auth()->user();
            $allergy = Allergy::where('id', $id)->first();
            
            return view('admin.allergy.allergy_edit',compact('user_data','allergy'));
        }

        return redirect("admin/login")->withSuccess('You are not allowed to access');
    }
    
    
    public function update(Request $request){
        $validatedData = $request->validate([
            'name' => 'required',

        ]);

        $id = $request->id;
        $datauser = [
             'name' => $request->name,
        ];

        Allergy::where('id', $id)->update($datauser);


        return redirect()->route('admin.allergy.list')->with('success','Allergy created successfully.');
    }




    public function delete($id)
    {
        $deleted = Allergy::where('id', $id)->delete();
        return response()->json(['success'=>'Allergy Deleted Successfully!']);
    }


    public function status(Request $request){
        
        $id = $request->id;
        $datauser = [
             'status' => $request->status,
        ];

        Allergy::where('id', $id)->update($datauser);


        return response()->json(['success'=>'Allergy Status Changes Successfully!']);
    }
}
