<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\{
    User,
    Addiction
};


use Exception;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\{
    Auth,
    Hash,
    Session
};



class AddictionController extends Controller
{
    public function index(){
        if(Auth::check()){
            $user_data = auth()->user();

            $addiction_list = Addiction::paginate(10);
            
            return view('admin.addiction.addiction_list',compact('user_data','addiction_list'))->with('i', (request()->input('page', 1) - 1) * 1);
        }

        return redirect("admin/login")->withSuccess('You are not allowed to access');
    }




    public function create(){
        if(Auth::check()){
            $user_data = auth()->user();
            
            return view('admin.addiction.addiction_add',compact('user_data'));
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

        $id = Addiction::insertGetId($datauser);


        return redirect()->route('admin.addiction.list')->with('success','addiction created successfully.');

    }



    public function edit($id){
        if(Auth::check()){
            $user_data = auth()->user();
            $addiction = Addiction::where('id', $id)->first();
            
            return view('admin.addiction.addiction_edit',compact('user_data','addiction'));
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

        Addiction::where('id', $id)->update($datauser);


        return redirect()->route('admin.addiction.list')->with('success','addiction created successfully.');
    }




    public function delete($id)
    {
        $deleted = Addiction::where('id', $id)->delete();
        return response()->json(['success'=>'addiction Deleted Successfully!']);
    }


    public function status(Request $request){
        
        $id = $request->id;
        $datauser = [
             'status' => $request->status,
        ];

        Addiction::where('id', $id)->update($datauser);


        return response()->json(['success'=>'addiction Status Changes Successfully!']);
    }
}
