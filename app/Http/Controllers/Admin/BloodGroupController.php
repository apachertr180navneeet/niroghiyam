<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\{
    User,
    Blood_Group
};


use Exception;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\{
    Auth,
    Hash,
    Session
};

class BloodGroupController extends Controller
{
    public function index(){
        if(Auth::check()){
            $user_data = auth()->user();

            $blood_group_list = Blood_Group::paginate(10);
            
            return view('admin.blood_group.blood_group_list',compact('user_data','blood_group_list'))->with('i', (request()->input('page', 1) - 1) * 1);
        }

        return redirect("admin/login")->withSuccess('You are not allowed to access');
    }




    public function create(){
        if(Auth::check()){
            $user_data = auth()->user();
            
            return view('admin.blood_group.blood_group_add',compact('user_data'));
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

        $id = Blood_Group::insertGetId($datauser);


        return redirect()->route('admin.blood_group.list')->with('success','blood group created successfully.');

    }



    public function edit($id){
        if(Auth::check()){
            $user_data = auth()->user();
            $bloodgroup = blood_group::where('id', $id)->first();
            
            return view('admin.blood_group.blood_group_edit',compact('user_data','bloodgroup'));
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

        Blood_Group::where('id', $id)->update($datauser);


        return redirect()->route('admin.blood_group.list')->with('success','blood group created successfully.');
    }




    public function delete($id)
    {

        $deleted = Blood_Group::where('id', $id)->delete();
        return response()->json(['success'=>'blood group Deleted Successfully!']);
    }



    public function status(Request $request){
        
        $id = $request->id;
        $datauser = [
             'status' => $request->status,
        ];

        Blood_Group::where('id', $id)->update($datauser);


        return response()->json(['success'=>'Allergy Status Changes Successfully!']);
    }
}
