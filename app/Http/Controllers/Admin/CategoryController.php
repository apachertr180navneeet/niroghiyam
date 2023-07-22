<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\{
    User,
    Category
};


use Exception;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\{
    Auth,
    Hash,
    Session
};



use URL;




class CategoryController extends Controller
{
    public function index(){
        if(Auth::check()){
            $user_data = auth()->user();

            $category_list = Category::paginate(10);
            
            return view('admin.category.category_list',compact('user_data','category_list'))->with('i', (request()->input('page', 1) - 1) * 1);
        }

        return redirect("admin/login")->withSuccess('You are not allowed to access');
    }




    public function create(){
        if(Auth::check()){
            $user_data = auth()->user();
            
            return view('admin.category.category_add',compact('user_data'));
        }

        return redirect("admin/login")->withSuccess('You are not allowed to access');
    }


    public function store(Request $request){

        $validatedData = $request->validate([
            'name' => 'required',
        ]);

        $baseUrl = url('/');


        $file = $request->file('caticon');
        $filename = time().'.'.$file->getClientOriginalExtension();
        
        
        
        // File upload location
        $location = 'uploads';
        
        $imageupload = $baseUrl.'/'.$location.'/'.$filename;
        
        // Upload file
        $file->move($location,$filename);


        $datauser = [
             'name' => $request->name,
             'image' => $imageupload
        ];
        

        $id = Category::insertGetId($datauser);


        return redirect()->route('admin.category.list')->with('success','User created successfully.');

    }



    public function edit($id){
        if(Auth::check()){
            $user_data = auth()->user();
            $category = Category::where('id', $id)->first();
            
            return view('admin.category.category_edit',compact('user_data','category'));
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

        Category::where('id', $id)->update($datauser);


        return redirect()->route('admin.category.list')->with('success','Category created successfully.');
    }




    public function delete($id)
    {

        $deleted = Category::where('id', $id)->delete();
        return response()->json(['success'=>'Allergy Deleted Successfully!']);
    }


    public function status(Request $request){
        
        $id = $request->id;
        $datauser = [
             'status' => $request->status,
        ];

        Category::where('id', $id)->update($datauser);


        return response()->json(['success'=>'Allergy Status Changes Successfully!']);
    }
}
