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
    UploadReport,
    UserPackage
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
    public function upload_report(Request $request)
    {
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
        $location = 'uploads';

        $reportcount = UploadReport::where('userid', $userid)->count();

        // Check if user can upload more files
        if ($reportcount >= 5) {
            $membershipCheck = UserPackage::where('user_id', $userid)->first();
            if (empty($membershipCheck)) {
                return $this->sendError('Please buy membership first');
            }
        }
        // Loop through each file and upload it
        foreach ($request->file('file') as $file) {
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $filePath = $baseUrl . '/' . $location . '/' . $filename;
            $file->move($location, $filename);

            // Prepare data for each file upload
            $datauser = [
                'titel' => $titel,
                'date' => $date,
                'file' => $filePath,
                'category_id' => $category_id,
                'userid' => $userid,
            ];

            // Insert each file record into the database
            UploadReport::create($datauser);
        }

        return $this->sendResponse(null, 'Files uploaded successfully');
    }
    public function report_list(Request $request){
        $userid = $request->userid;
        $report_list_list = UploadReport::where('userid', $userid)->get();
        if(count($report_list_list) != 0){
            return $this->sendResponse(UploadReportResource::collection($report_list_list), 'Report retrieved successfully.');
        }else{
            return $this->sendError('No record Found');
        }
    }
    public function category_report_list(Request $request){
        $userid = $request->userid;
        $categoryid = $request->categoryid;
        $report_list_list = UploadReport::where('userid', $userid)->where('category_id', $categoryid)->get();
        if(count($report_list_list) != 0){
            return $this->sendResponse(UploadReportResource::collection($report_list_list), 'Report retrieved successfully.');
        }else{
            return $this->sendError('No record Found');
        }
    }
    public function report_search(Request $request){
        $userid = $request->userid;
        $name = $request->name;
        $report_search = UploadReport::where('userid', $userid)->where('titel','LIKE','%'.$name.'%')->get();
        if(count($report_search) != 0){
            return $this->sendResponse(UploadReportResource::collection($report_search), 'Report retrieved successfully.');
        }else{
            return $this->sendError('No record Found');
        }
    }
    public function report_delete(Request $request){
        $id = $request->id;
        $ReportDelete = UploadReport::find($id);
        if (!$ReportDelete) {
            return response()->json(['message' => 'Report not found'], 404);
        }
        $ReportDelete->delete();
        return response()->json(['message' => 'Report deleted successfully']);
    }
    public function report_edit(Request $request){
        $id = $request->id;
        $UploadReportdata = UploadReport::find($id);
        if (!$UploadReportdata) {
            return response()->json(['message' => 'Upload Report not found'], 404);
        }else{
            return $this->sendResponse($UploadReportdata, 'Upload Report Get');
        }
    }
    public function report_update(Request $request){
        $id = $request->id;
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
            'date' => $date,
            'file' => $imageupload,
            'category_id' => $category_id,
            'userid' => $userid,
       ];
       $record = UploadReport::where('id', $id);
       $record->update($datauser);
       return $this->sendResponse($record, 'Report Update');
    }
    public function report_view(Request $request){
        $id = $request->id;
        $UploadReportdata = UploadReport::find($id);
        if (!$UploadReportdata) {
            return response()->json(['message' => 'Upload Report not found'], 404);
        }else{
            return $this->sendResponse($UploadReportdata, 'Upload Report Get');
        }
    }
}
