<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;


use App\Models\{
    User,
    UploadReport
};


use Exception;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\{
    Auth,
    Hash,
    Session
};

use Carbon\Carbon;

class DownloadReportController extends Controller
{
    public function index($id){
        $usercheck = User::where('urlslug', $id)->first();
        if($usercheck){
            return view('website.reportotp',compact('usercheck'));
        }
    }

    public function otpcheck(Request $request){
        $usercheck = User::where('id', $request->userid)->where('report_otp', $request->otp)->first();
        if(empty($usercheck)){
            return redirect()->back()->withErrors('msg', 'Invalid Otp');
        }else{
            $usersReport = UploadReport::select('file','titel')->where('userid', $request->userid)->get()->toArray();
            return view('website.downloadreport',compact('usersReport'));
        }
    }
}
