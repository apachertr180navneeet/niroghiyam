<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;


use App\Http\Controllers\Api\ApiBaseController as ApiBaseController;

use App\Models\{
    User,
    User_detail,
    User_kyc,
    Membership,
    Blood_Group,
    Allergy
};




use Illuminate\Support\Facades\{
    Auth,
    Hash,
    Session
};
use Validator;

use App\Http\Resources\{
    MemebershipResource,
    BloodGroupResource,
    AllergyResources
};
use Illuminate\Http\JsonResponse;


class CommonController extends ApiBaseController
{
    public function getmembership(){
            
        $memebership_list = Membership::where('status', '1')->get();
    
        return $this->sendResponse(MemebershipResource::collection($memebership_list), 'Membership retrieved successfully.');
    }
    
    
    public function getbloodgroup(){
            
        $bloodgroup_list = Blood_Group::where('status', '1')->get();
    
        return $this->sendResponse(BloodGroupResource::collection($bloodgroup_list), 'Blood Group retrieved successfully.');
    }
    
    public function getallergy(){
            
        $allergy_list = Allergy::where('status', '1')->get();
    
        return $this->sendResponse(AllergyResources::collection($allergy_list), 'Allergy retrieved successfully.');
    }
}
