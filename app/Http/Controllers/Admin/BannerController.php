<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\{
    User,
    Banner
};


use Exception;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\{
    Auth,
    Hash,
    Session
};



use URL;




class BannerController extends Controller
{
    public function index(){
        if(Auth::check()){
            $user_data = auth()->user();
            

            $banner_list = Banner::select('banner.banner_id','banner.banner_titel','banner.banner_image','banner.status')->paginate(10);
            
            return view('admin.banner.banner_list',compact('user_data','banner_list'))->with('i', (request()->input('page', 1) - 1) * 1);
        }

        return redirect("admin/login")->withSuccess('You are not allowed to access');
    }

    public function create(){
        if(Auth::check()){
            $user_data = auth()->user();

            $user_list = User::where('type', '1')->get();
            
            return view('admin.banner.banner_add',compact('user_data','user_list'));
        }

        return redirect("admin/login")->withSuccess('You are not allowed to access');
    }

    public function store(Request $request){

        $validatedData = $request->validate([
            'name' => 'required',
        ]);

        $baseUrl = url('/');


        $file = $request->file('image');
        $filename = time().'.'.$file->getClientOriginalExtension();
        
        
        
        // File upload location
        $location = 'uploads';
        
        $imageupload = $baseUrl.'/'.$location.'/'.$filename;
        
        // Upload file
        $file->move($location,$filename);


        $datauser = [
             'banner_titel' => $request->name,
             'banner_image' => $imageupload
        ];
        

        $id = Banner::insertGetId($datauser);


        return redirect()->route('admin.banner.list')->with('success','Banner created successfully.');

    }

    public function delete($id)
    {

        $deleted = Banner::where('banner_id', $id)->delete();
        return response()->json(['success'=>'Banner Deleted Successfully!']);
    }


    public function status(Request $request){
        
        $id = $request->id;
        $datauser = [
             'status' => $request->status,
        ];

        Banner::where('banner_id', $id)->update($datauser);


        return response()->json(['success'=>'Banner Status Changes Successfully!']);
    }
}
