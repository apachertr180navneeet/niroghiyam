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
    Category,
    CMS,
    Banner,
    Logs,
    VacinationCart,
    Setting,
    Addiction
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
    CategoryResource,
    CmsResource,
    BannerResources,
    NotificationResources,
    VaccinationCartResource,
    SettingResource,
    AddictionResources
};
use Illuminate\Http\JsonResponse;


class CommonController extends ApiBaseController
{
    public function getmembership(){
            
        $memebership_list = Membership::where('status', '1')->select('memberships.id AS membership_id','memberships.name AS membership_name','memberships.description','memberships.amount','membership_mode.name AS membership_mode_name')->join('membership_mode', 'membership_mode.id', '=', 'memberships.membership_mode')->get();

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

    public function getaddiction(){
            
        $adiction_list = Addiction::where('status', '1')->get();
    
        
        if(!empty($adiction_list)){
            return $this->sendResponse(AddictionResources::collection($adiction_list), 'Adiction retrieved successfully.');
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



    public function categorysearch(Request $request){

        $name = $request->name;
            
        $category_list = Category::where('name','LIKE','%'.$name.'%')->get();


        if(count($category_list) != 0){
            return $this->sendResponse(CategoryResource::collection($category_list), 'Category retrieved successfully.');
        }else{
            return $this->sendError('No record Found');
        }
    }


    public function term_and_condition(Request $request){

        $name = $request->name;
            
        $category_list = CMS::where('page_slug','term and condition')->get();


        if(count($category_list) != 0){
            return $this->sendResponse(CmsResource::collection($category_list), 'Term And Condition retrieved successfully.');
        }else{
            return $this->sendError('No record Found');
        }
    }


    public function contact_us(Request $request){

        $name = $request->name;
            
        $category_list = CMS::where('page_slug','contact_us')->get();


        if(count($category_list) != 0){
            return $this->sendResponse(CmsResource::collection($category_list), 'contact us retrieved successfully.');
        }else{
            return $this->sendError('No record Found');
        }
    }


    public function about_us(Request $request){

        $name = $request->name;
            
        $category_list = CMS::where('page_slug','about us')->get();


        if(count($category_list) != 0){
            return $this->sendResponse(CmsResource::collection($category_list), 'About Us retrieved successfully.');
        }else{
            return $this->sendError('No record Found');
        }
    }



    public function privacy_policy(Request $request){

        $name = $request->name;
            
        $category_list = CMS::where('page_slug','privacy policy')->get();


        if(count($category_list) != 0){
            return $this->sendResponse(CmsResource::collection($category_list), 'Privacy Policy retrieved successfully.');
        }else{
            return $this->sendError('No record Found');
        }
    }



    public function return_policy(Request $request){

        $name = $request->name;
            
        $category_list = CMS::where('page_slug','return policy')->get();


        if(count($category_list) != 0){
            return $this->sendResponse(CmsResource::collection($category_list), 'Return Policy retrieved successfully.');
        }else{
            return $this->sendError('No record Found');
        }
    }


    public function banner_list(Request $request){

        $userid = '1';
            
        $banner_list = Banner::where('status',$userid)->get();


        if(count($banner_list) != 0){
            return $this->sendResponse(BannerResources::collection($banner_list), 'Banner retrieved successfully.');
        }else{
            return $this->sendError('No record Found');
        }
    }


    public function notification_list(Request $request){

        $userid = $request->userid;
            
        $logs_list = Logs::where('user_id',$userid)->get();


        if(count($logs_list) != 0){
            return $this->sendResponse(NotificationResources::collection($logs_list), 'Notification retrieved successfully.');
        }else{
            return $this->sendError('No record Found');
        }
    }

    public function vacination_cart(Request $request){

        $cartid = $request->cartid;
            
        $vcaination_cart = VacinationCart::where('vacicnation_parente','!=',0)->get();


        if(count($vcaination_cart) != 0){
            return $this->sendResponse(VaccinationCartResource::collection($vcaination_cart), 'Notification retrieved successfully.');
        }else{
            return $this->sendError('No record Found');
        }
    }

    public function setting(Request $request){

            
        $setting = Setting::where('id',1)->get();
        return $this->sendResponse(SettingResource::collection($setting), 'Setting retrieved successfully.');
        
    }
}
