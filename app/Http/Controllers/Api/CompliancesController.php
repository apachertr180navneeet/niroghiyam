<?php
namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiBaseController as ApiBaseController;
use App\Models\{
    Compliances,
    CompliancesMessgae
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
                'titel' => $titel,
                'description' => $description,
                'file' => $imageupload,
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
    public function compliances_edit(Request $request){
        $id = $request->id;
        $Compliancesdata = Compliances::find($id);
        if (!$Compliancesdata) {
            return response()->json(['message' => 'Compliancesdata not found'], 404);
        }else{
            return $this->sendResponse($Compliancesdata, 'Compliancesdata Get');
        }
    }
    public function compliances_update(Request $request){
        $id = $request->id;
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
            'titel' => $titel,
            'description' => $description,
            'file' => $imageupload,
            'userid' => $userid,
        ];

       $record = Compliances::find($id);
       $record->update($datauser);
       return $this->sendResponse($record, 'Vaccination Update');
    }
    public function compliances_delete(Request $request){
        $id = $request->id;
        $Compliances = Compliances::find($id);
        if (!$Compliances) {
            return response()->json(['message' => 'Compliances not found'], 404);
        }
        $Compliances->delete();
        return response()->json(['message' => 'Compliances deleted successfully']);
    }
}
