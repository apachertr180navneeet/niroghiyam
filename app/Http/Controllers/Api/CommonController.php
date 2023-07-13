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
    Allergy,
    Category
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
    AllergyResources,
    CategoryResource
};
use Illuminate\Http\JsonResponse;


class CommonController extends ApiBaseController
{
    public function getmembership(){
            
        $memebership_list = Membership::where('status', '1')->get();

        if(!empty($memebership_list)){
            return $this->sendResponse(MemebershipResource::collection($memebership_list), 'Membership retrieved successfully.');
        }else{
            return $this->sendError('No record Found');
        }
    }
    
    
    public function getbloodgroup(){
            
        $bloodgroup_list = Blood_Group::where('status', '1')->get();
    
        if(!empty($bloodgroup_list)){
            return $this->sendResponse(BloodGroupResource::collection($bloodgroup_list), 'Membership retrieved successfully.');
        }else{
            return $this->sendError('No record Found');
        }
    }
    
    public function getallergy(){
            
        $allergy_list = Allergy::where('status', '1')->get();
    
        
        if(!empty($allergy_list)){
            return $this->sendResponse(AllergyResources::collection($allergy_list), 'Allergy retrieved successfully.');
        }else{
            return $this->sendError('No record Found');
        }
    }


    public function getcategory(){
            
        $category_list = Category::where('status', '1')->get();

        if(!empty($category_list)){
            return $this->sendResponse(CategoryResource::collection($category_list), 'Category retrieved successfully.');
        }else{
            return $this->sendError('No record Found');
        }
    }
}
