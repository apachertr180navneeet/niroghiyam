<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;


use App\Http\Controllers\Api\ApiBaseController as ApiBaseController;

use App\Models\{
    Vaccination
};



use App\Http\Resources\{
    VaccinationResource,
    YearResource
};




use Illuminate\Support\Facades\{
    Auth,
    Hash,
    Session
};
use Validator;

use URL;

class VaccinationController extends ApiBaseController
{
    public function vaccinationadd(Request $request){


            $request->validate([
                'user_id' => 'required',
                'vaccination_date' => 'required',
                'name' => 'required',
                'vaccination_next_schedule' => 'required',
                'place' => 'required',
                'age' => 'required',
                'vaccination_type' => 'required'
            ]);


            $user_id = $request->user_id;
            $vaccination_date = $request->vaccination_date;
            $name = $request->name;
            $vaccination_next_schedule = $request->vaccination_next_schedule;
            $place = $request->place;
            $remark = $request->remark;
            $age = $request->age;
            $vaccination_type = $request->vaccination_type;




            $datauser = [
                'user_id' => $user_id,
                'vaccination_date' => $vaccination_date,
                'name' => $name,
                'vaccination_next_schedule' => $vaccination_next_schedule,
                'place' => $place,
                'remark' => $remark,
                'age' => $age,
                'vaccination_type' => $vaccination_type

           ];

           $success = Vaccination::create($datauser);



            return $this->sendResponse($success, 'Vaccination Created');
    }

    public function vaccination_list(Request $request){

        $userid = $request->userid;

        $vaccination_list = Vaccination::where('user_id', $userid)->get();

        if(count($vaccination_list) != 0){
            return $this->sendResponse(VaccinationResource::collection($vaccination_list), 'Vaccination retrieved successfully.');
        }else{
            return $this->sendError('No record Found');
        }
    }

    public function vaccination_year_list(Request $request){

        $userid = $request->userid;
        $useryear = $request->year;

        $vaccination_list_year = Vaccination::where('user_id', $userid)->where('created_at', 'LIKE', "%$useryear%")->get();
        if(count($vaccination_list_year) != 0){
            return $this->sendResponse(VaccinationResource::collection($vaccination_list_year), 'Vaccination retrieved successfully.');
        }else{
            return $this->sendError('No record Found');
        }
    }

    public function vaccination_delete(Request $request){
        $id = $request->id;
        $vaccination = Vaccination::find($id);
        if (!$vaccination) {
            return response()->json(['message' => 'Vaccination not found'], 404);
        }
        $vaccination->delete();
        return response()->json(['message' => 'Vaccination deleted successfully']);
    }

    public function vaccination_edit(Request $request){
        $id = $request->id;
        $vaccinationdata = Vaccination::find($id);
        if (!$vaccinationdata) {
            return response()->json(['message' => 'Vaccination not found'], 404);
        }else{
            return $this->sendResponse($vaccinationdata, 'Vaccination Get');
        }
    }

    public function vaccination_update(Request $request){
        $id = $request->id;
        $request->validate([
            'user_id' => 'required',
            'vaccination_date' => 'required',
            'name' => 'required',
            'place' => 'required',
            'age' => 'required',
            'vaccination_type' => 'required'
        ]);


        $user_id = $request->user_id;
        $vaccination_date = $request->vaccination_date;
        $name = $request->name;
        $vaccination_next_schedule = $request->vaccination_next_schedule;
        $place = $request->place;
        $remark = $request->remark;
        $age = $request->age;
        $vaccination_type = $request->vaccination_type;




        $datauser = [
            'user_id' => $user_id,
            'vaccination_date' => $vaccination_date,
            'name' => $name,
            'vaccination_next_schedule' => $vaccination_next_schedule,
            'place' => $place,
            'remark' => $remark,
            'age' => $age,
            'vaccination_type' => $vaccination_type

       ];

       $record = Vaccination::find($id);
       $record->update($datauser);



        return $this->sendResponse($record, 'Vaccination Update');
    }
}
