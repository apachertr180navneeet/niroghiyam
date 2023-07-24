<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\Api\{
    RegisterController,
    UserController,
    CommonController,
    HomeController,
    UploadReportController,
    CompliancesController
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
    Route::post('checkotp', 'checkotp');
    Route::post('resendotp', 'resendotp');
    Route::post('userkyc', 'userkyc');
});




Route::controller(UserController::class)->group(function(){
    Route::post('get_user', 'getuser');
    Route::post('profile_update', 'profileupdate');
});



Route::controller(CommonController::class)->group(function(){
    Route::post('get_membership', 'getmembership');
    Route::post('get_bloodgroup', 'getbloodgroup');
    Route::post('get_allergy', 'getallergy');
    Route::post('get_category', 'getcategory');
    Route::post('category_search', 'categorysearch');
});


Route::controller(HomeController::class)->group(function(){
    Route::post('home_screen', 'home_screen');
});


Route::controller(UploadReportController::class)->group(function(){
    Route::post('upload_report', 'upload_report');
    Route::post('report_list', 'report_list');
});



Route::controller(CompliancesController::class)->group(function(){
    Route::post('compliancesadd', 'compliancesadd');
    Route::post('compliances_list', 'compliances_list');
});
