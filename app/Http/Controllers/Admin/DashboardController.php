<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\{
    User,
    Setting
};


use Exception;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\{
    Auth,
    Hash,
    Session
};




class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function dashboard()
    {
        if(Auth::check()){
            $user_data = auth()->user();

            $userCount = User::where('type', '1')->count();
            $userCountActive = User::where('type', '1')->where('status', '1')->count();
            $userCountInActive = User::where('type', '1')->where('status', '0')->count();
            
            return view('admin.dashboard.dashboard',compact('user_data','userCount','userCountActive','userCountInActive'));
        }

        return redirect("admin/login")->withSuccess('You are not allowed to access');
    }

    public function setting(){
        if(Auth::check()){
            $user_data = auth()->user();

            $settingdata = Setting::where('id', '1')->first();
            
            return view('admin.setiing.setting_edit',compact('user_data','settingdata'));
        }

        return redirect("admin/login")->withSuccess('You are not allowed to access');
    }


    public function edit(Request $request){
       

        $id = $request->id;

        $baseUrl = url('/');



        $datauser = [
            'title' => $request->title,
            'andriod_app_link' => $request->andriod_app_link,
            'facebook' => $request->facebook,
            'instagram' => $request->instagram,
            'facebook' => $request->facebook,
            'linkedin' => $request->linkedin,
            'twitter' => $request->twitter,
            'razor_pay_key' => $request->razor_pay_key,
        ];
        
        if (!empty($request->file('vedio'))) {
            $vedio = $request->file('vedio');
            $vedioname = time() . '.' . $vedio->getClientOriginalExtension();
        
            $location = 'uploads';
            $vedioupload = $baseUrl . '/' . $location . '/' . $vedioname;
        
            $vedio->move($location, $vedioname);
        
            $datauser['vedio'] = $vedioupload;
        }
        
        if (!empty($request->file('app_logo'))) {
            $app_logo = $request->file('app_logo');
            $app_logoname = time() . '.' . $app_logo->getClientOriginalExtension();
        
            $location = 'uploads';
            $app_logonameupload = $baseUrl . '/' . $location . '/' . $app_logoname;
        
            $app_logo->move($location, $app_logoname);
        
            $datauser['app_logo'] = $app_logonameupload;
        }

        if (!empty($request->file('andqr'))) {
            $andqr = $request->file('andqr');
            $andqrname = time() . '.' . $andqr->getClientOriginalExtension();
        
            $location = 'uploads';
            $andqrnameupload = $baseUrl . '/' . $location . '/' . $andqrname;
        
            $andqr->move($location, $andqrname);
        
            $datauser['andqr'] = $andqrnameupload;
        }

        if (!empty($request->file('iosqrcode'))) {
            $iosqrcode = $request->file('iosqrcode');
            $iosqrcodename = time() . '.' . $iosqrcode->getClientOriginalExtension();
        
            $location = 'uploads';
            $iosqrcodenameupload = $baseUrl . '/' . $location . '/' . $iosqrcodename;
        
            $iosqrcode->move($location, $iosqrcodename);
        
            $datauser['iosqrcode'] = $iosqrcodenameupload;
        }

        if (!empty($request->file('vaccinationchart'))) {
            $vaccinationchart = $request->file('vaccinationchart');
            $vaccinationchartname = time() . '.' . $vaccinationchart->getClientOriginalExtension();
        
            $location = 'uploads';
            $vaccinationchartnameupload = $baseUrl . '/' . $location . '/' . $vaccinationchartname;
        
            $vaccinationchart->move($location, $vaccinationchartnameupload);
        
            $datauser['vaccinationchart'] = $vaccinationchartnameupload;
        }
        
        Setting::where('id', $request->id)->update($datauser);
        


        return redirect()->route('admin.setting')->with('success','Setting created successfully.');
    }

    public function logout() {
        Session::flush();
        Auth::logout();

        return Redirect('admin/login');
    }
}
