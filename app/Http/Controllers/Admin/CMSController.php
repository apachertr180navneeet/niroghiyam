<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;


use App\Models\{
    User,
    CMS
};


use Exception;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\{
    Auth,
    Hash,
    Session
};

class CMSController extends Controller
{
    public function index(){
        if(Auth::check()){
            $user_data = auth()->user();

            $cms_list = CMS::paginate(10);
            
            return view('admin.cms.cms_list',compact('user_data','cms_list'))->with('i', (request()->input('page', 1) - 1) * 1);
        }

        return redirect("admin/login")->withSuccess('You are not allowed to access');
    }




    public function create(){
        if(Auth::check()){
            $user_data = auth()->user();
            
            return view('admin.cms.cms_add',compact('user_data'));
        }

        return redirect("admin/login")->withSuccess('You are not allowed to access');
    }


    public function store(Request $request){

        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $slug = strtolower($request->name);

        $datacms = [
             'page_name' => $request->name,
             'page_slug' => $slug,
             'description' => $request->description
        ];

        $id = CMS::insertGetId($datacms);


        return redirect()->route('admin.cms.list')->with('success','CMS created successfully.');

    }



    public function edit($id){
        if(Auth::check()){
            $user_data = auth()->user();
            $cms = CMS::where('id', $id)->first();
            
            return view('admin.cms.cms_edit',compact('user_data','cms'));
        }

        return redirect("admin/login")->withSuccess('You are not allowed to access');
    }
    
    
    public function update(Request $request){
        $validatedData = $request->validate([
            'name' => 'required',

        ]);

        $id = $request->id;
        $datacms = [
            //'page_name' => $request->name,
            'description' => $request->description
       ];

        CMS::where('id', $id)->update($datacms);


        return redirect()->route('admin.cms.list')->with('success','CMS created successfully.');
    }




    public function delete($id)
    {
        $deleted = CMS::where('id', $id)->delete();
        return response()->json(['success'=>'CMS Deleted Successfully!']);
    }


    public function status(Request $request){
        
        $id = $request->id;
        $datauser = [
             'status' => $request->status,
        ];

        CMS::where('id', $id)->update($datauser);


        return response()->json(['success'=>'CMS Status Changes Successfully!']);
    }
}
