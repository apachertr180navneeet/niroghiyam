<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;


use App\Http\Controllers\Api\ApiBaseController as ApiBaseController;

use App\Models\{
    Compliances
};



use App\Http\Resources\{
    CompliancesResource
};




use Illuminate\Support\Facades\{
    Auth,
    Hash,
    Session
};
use Validator;

use URL;

class CompliancesController extends ApiBaseController
{
    public function compliancesadd(Request $request){
            

            $request->validate([
                'userid' => 'required',
                'titel' => 'required',
                'description' => 'required',
            ]);


            $userid = $request->userid;
            $titel = $request->titel;
            $description = $request->description;
            $category_id = $request->category_id;


            $baseUrl = url('/');

            // File upload location
            $location = 'uploads';
            
            $file = $request->file('file');
            $filename = time().'.'.$file->getClientOriginalExtension();

            $files = $baseUrl.'/'.$location.'/'.$filename;



            $datauser = [
                'titel' => $titel,
                'description' => $description,
                'file' => $files,
                'userid' => $userid,

           ];
    
           $success = Compliances::create($datauser);

            
            
            return $this->sendResponse($success, 'Compliances Created');
    }



    public function compliances_list(Request $request){

        $userid = $request->userid;
            
        $compliances_list = Compliances::where('userid', $userid)->get();
    
        if(count($compliances_list) != 0){
            return $this->sendResponse(CompliancesResource::collection($compliances_list), 'Compliances retrieved successfully.');
        }else{
            return $this->sendError('No record Found');
        }
    }
}
