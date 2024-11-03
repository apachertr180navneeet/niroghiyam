<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\Api\{
    RegisterController,
    UserController,
    CommonController,
    HomeController,
    UploadReportController,
    CompliancesController,
    VaccinationController,
    EmergancyContactController,
    UserPackageController
};

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });




Route::controller(RegisterController::class)->group(function(){
    Route::post('register', 'register');
    Route::post('login', 'login');
    Route::post('forgotpassword', 'forgotPassword');
    Route::post('checkotp', 'checkotp');
    Route::post('resendotp', 'resendotp');
    Route::post('userkyc', 'userkyc');
    Route::post('changepassword', 'changePassword');
    Route::post('emergencymssage', 'EmergencyMssage');
});




Route::controller(UserController::class)->group(function(){
    Route::post('get_user', 'getuser');
    Route::post('profile_update', 'profileupdate');
    Route::post('user_membership', 'usermembership');
    Route::post('get_user_membership', 'getusermembership');
    Route::post('get_user_kyc', 'getuserkyc');
});



Route::controller(CommonController::class)->group(function(){
    Route::post('get_membership', 'getmembership');
    Route::post('get_bloodgroup', 'getbloodgroup');
    Route::post('get_allergy', 'getallergy');
    Route::post('get_category', 'getcategory');
    Route::post('category_search', 'categorysearch');
    Route::post('term_and_condition', 'term_and_condition');
    Route::post('contact_us', 'contact_us');
    Route::post('about_us', 'about_us');
    Route::post('return_policy', 'return_policy');
    Route::post('privacy_policy', 'privacy_policy');
    Route::post('banner_list', 'banner_list');
    Route::post('notification_list', 'notification_list');
    Route::post('vacination_cart', 'vacination_cart');
    Route::post('setting', 'setting');
    Route::post('addiction','getaddiction');
});


Route::controller(HomeController::class)->group(function(){
    Route::post('home_screen', 'home_screen');
    Route::post('intro_vedio', 'intro_vedio');
});


Route::controller(UploadReportController::class)->group(function(){
    Route::post('upload_report', 'upload_report');
    Route::post('report_list', 'report_list');
    Route::post('report_delete', 'report_delete');
    Route::post('report_edit', 'report_edit');
    Route::post('report_update', 'report_update');
    Route::post('category_report_list', 'category_report_list');
    Route::post('report_search', 'report_search');
    Route::post('report_view', 'report_view');
});



Route::controller(CompliancesController::class)->group(function(){
    Route::post('compliancesadd', 'compliancesadd');
    Route::post('compliances_list', 'compliances_list');
    Route::post('compliances_edit', 'compliances_edit');
    Route::post('compliances_update', 'compliances_update');
    Route::post('compliances_delete', 'compliances_delete');
});

Route::controller(VaccinationController::class)->group(function(){
    Route::post('vaccinationadd', 'vaccinationadd');
    Route::post('vaccination_list', 'vaccination_list');
    Route::post('vaccination_edit', 'vaccination_edit');
    Route::post('vaccination_delete', 'vaccination_delete');
    Route::post('vaccination_update', 'vaccination_update');
    Route::post('vaccination_year_list', 'vaccination_year_list');
});


Route::controller(EmergancyContactController::class)->group(function(){
    Route::post('emergancycontactadd', 'emergancycontactadd');
    Route::post('emergancycontactlist', 'emergancycontactlist');
    Route::post('emergancycontactdelete', 'emergancycontactdelete');
    Route::post('emergancycontact_edit', 'emergancycontactedit');
    Route::post('emergancycontact_update', 'emergancycontactupdate');
});


// Api create pending

