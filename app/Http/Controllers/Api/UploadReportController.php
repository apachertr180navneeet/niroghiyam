<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;


use App\Http\Controllers\Api\ApiBaseController as ApiBaseController;

use App\Models\{
    User,
    User_detail,
    User_kyc,
    Blood_Group,
    Allergy,
    UploadReport
};



use App\Http\Resources\{
    UploadReportResource
};




use Illuminate\Support\Facades\{
    Auth,
    Hash,
    Session
};
use Validator;

use URL;

class UploadReportController extends ApiBaseController
{
    public function upload_report(Request $request){
            

            $request->validate([
                'userid' => 'required',
                'titel' => 'required',
                'date' => 'required',
            ]);


            $userid = $request->userid;
            $titel = $request->titel;
            $date = $request->date;
            $category_id = $request->category_id;


            $baseUrl = url('/');

            // File upload location
            $location = 'uploads';
            
            $file = $request->file('file');
            $filename = time().'.'.$file->getClientOriginalExtension();

            $files = $baseUrl.'/'.$location.'/'.$filename;



            $datauser = [
                'titel' => $titel,
                'date' => $date,
                'file' => $files,
                'category_id' => $category_id,
                'userid' => $userid,

           ];
    
           $success = UploadReport::create($datauser);

            
            
            return $this->sendResponse($success, 'Home Screen Data');
    }



    public function report_list(Request $request){

        $userid = $request->userid;
            
        $report_list_list = UploadReport::where('userid', $userid)->get();
    
        if(!empty($report_list_list)){
            return $this->sendResponse(UploadReportResource::collection($report_list_list), 'Report retrieved successfully.');
        }else{
            return $this->sendError('No record Found');
        }
    }


    public function category_report_list(Request $request){

        $userid = $request->userid;
        $categoryid = $request->categoryid;
            
        $report_list_list = UploadReport::where('userid', $userid)->where('category_id', $categoryid)->get();
    
        if(!empty($report_list_list)){
            return $this->sendResponse(UploadReportResource::collection($report_list_list), 'Report retrieved successfully.');
        }else{
            return $this->sendError('No record Found');
        }
    }
}
