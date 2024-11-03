<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;


use App\Http\Controllers\Api\ApiBaseController as ApiBaseController;

use App\Models\{
    Emergancy_Contact
};

use App\Http\Resources\{
    EmergancyContactResource
};

use Illuminate\Support\Facades\{
    Auth,
    Hash,
    Session
};
use Validator;

use URL;

class EmergancyContactController extends ApiBaseController
{
    public function emergancycontactadd(Request $request){
            $request->validate([
                'userid' => 'required',
                'name' => 'required',
                'mobile' => 'required',
            ]);
            $userid = $request->userid;
            $name = $request->name;
            $mobile = $request->mobile;
            $baseUrl = url('/');
            if($request->file('image') != ""){
                $file = $request->file('image');
                $filename = time().'.'.$file->getClientOriginalExtension();
                // File upload location
                $location = 'uploads';
                $imageupload = $baseUrl.'/'.$location.'/'.$filename;
                // Upload file
                $file->move($location,$filename);
            }else{
                $imageupload = "";
            }
            $datauser = [
                'userid' => $userid,
                'emergancy_contact_name' => $name,
                'emergancy_contact_mobile' => $mobile,
                'emergancy_contact_image' => $imageupload
           ];
           $success = Emergancy_Contact::create($datauser);
           return $this->sendResponse($success, 'Emergancy Contact Created');
    }

    public function emergancycontactlist(Request $request){

        $userid = $request->userid;
            
        $emergancy_list = Emergancy_Contact::where('userid', $userid)->get();
    
        if(count($emergancy_list) != 0){
            return $this->sendResponse(EmergancyContactResource::collection($emergancy_list), 'Emergancy Contact retrieved successfully.');
        }else{
            return $this->sendError('No record Found');
        }
    }

    public function emergancycontactdelete(Request $request){

        $id = $request->id;
            
        $deleted = Emergancy_Contact::where('emergancy_contact_id', $id)->delete();

    
        if($deleted == 1){
            $success['message'] = 'record deleted';
            return $this->sendResponse($success, 'Emergancy Contact Deleted successfully.');
        }else{
            return $this->sendError('No record Found');
        }
    }

    public function emergancycontactedit(Request $request){
        $id = $request->id;
        $EmergancyContactdata = Emergancy_Contact::where('emergancy_contact_id', $id)->first();
        if (!$EmergancyContactdata) {
            return response()->json(['message' => 'Vaccination not found'], 404);
        }else{
            return $this->sendResponse($EmergancyContactdata, 'Vaccination Get');
        }
    }

    public function emergancycontactupdate(Request $request){
        $id = $request->id;
        $request->validate([
            'userid' => 'required',
            'name' => 'required',
            'mobile' => 'required',
        ]);
        $userid = $request->userid;
        $name = $request->name;
        $mobile = $request->mobile;
        $baseUrl = url('/');
        if($request->file('image') != ""){
            $file = $request->file('image');
            $filename = time().'.'.$file->getClientOriginalExtension();
            // File upload location
            $location = 'uploads';
            $imageupload = $baseUrl.'/'.$location.'/'.$filename;
            // Upload file
            $file->move($location,$filename);
        }else{
            $imageupload = "";
        }
        $datauser = [
            'userid' => $userid,
            'emergancy_contact_name' => $name,
            'emergancy_contact_mobile' => $mobile,
            'emergancy_contact_image' => $imageupload
       ];
       $record = Emergancy_Contact::where('emergancy_contact_id', $id);
       $record->update($datauser);

        
        
        return $this->sendResponse($record, 'Emergancy Contact Update');
    }
}
