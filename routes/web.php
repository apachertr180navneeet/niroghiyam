<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{

    LoginController,

    DashboardController,

    UserController,

    AllergyController,

    BloodGroupController,

    CategoryController,

    MembershipController,
    CMSController,
    ComplainsController,
    VaccinationController,
    TransictionListController,
    LogsController,
    BannerController,
    DownloadReportController,
    WebController,
    AddictionController
};
/*

|--------------------------------------------------------------------------

| Web Routes

|--------------------------------------------------------------------------

|

| Here is where you can register web routes for your application. These

| routes are loaded by the RouteServiceProvider and all of them will

| be assigned to the "web" middleware group. Make something great!

|

*/





Route::controller(WebController::class)->group(function () {
    Route::get('term_and_condition', 'term_and_condition')->name('term_and_condition');
    Route::get('about', 'about')->name('about');
    Route::get('privacy_policy', 'privacy_policy')->name('privacy_policy');
    Route::get('delete_user_account', 'delete_user_account')->name('delete_user_account');
    Route::post('delete_user', 'delete_user')->name('delete_user');
});
Route::name('download.')->controller(DownloadReportController::class)->group(function () {
    Route::get('report/{id}', 'index')->name('report');
    Route::post('otpcheck', 'otpcheck')->name('otpcheck');
});
// Admin URL
Route::name('admin.')->prefix('admin')->controller(LoginController::class)->group(function () {

    Route::get('login', 'index')->name('login');
    Route::post('custom-login', 'customLogin')->name('login.custom');
    Route::get('forgotpassword', 'forgotpassword')->name('forget.password');
    Route::post('forgotpasswordpost', 'forgotpasswordpost')->name('forget.password.post');
});
Route::name('admin.')->prefix('admin')->controller(DashboardController::class)->middleware('web')->group(function () {

    Route::get('dashboard', 'dashboard')->name('dashboard');
    Route::get('setting', 'setting')->name('setting');
    Route::post('setting_edit', 'edit')->name('setting.edit');
    Route::get('logout', 'logout')->name('logout');

});
Route::name('admin.')->prefix('admin')->controller(UserController::class)->middleware('web')->group(function () {

    Route::get('customer_list', 'index')->name('customer.list');

    Route::get('customer_add', 'create')->name('customer.add');

    Route::post('customer_store', 'store')->name('customer.store');

    Route::get('customer_view/{id}', 'view')->name('customer.view');

    Route::get('customer_edit/{id}', 'edit')->name('customer.edit');

    Route::post('customer_update', 'update')->name('customer.update');

    Route::delete('customer_delete/{id}', 'delete')->name('customer.delete');

    Route::get('customer_status/{id}', 'status')->name('customer.status');
    Route::get('customer_doc/{id}', 'document')->name('customer.doc');
});
Route::name('admin.')->prefix('admin')->controller(AddictionController::class)->middleware('web')->group(function () {
    Route::get('addiction_list', 'index')->name('addiction.list');
    Route::get('addiction_add', 'create')->name('addiction.add');
    Route::post('addiction_store', 'store')->name('addiction.store');
    Route::get('addiction_edit/{id}', 'edit')->name('addiction.edit');
    Route::post('addiction_update', 'update')->name('addiction.update');
    Route::delete('addiction_delete/{id}', 'delete')->name('addiction.delete');
    Route::get('addiction_status/{id}', 'status')->name('addiction.status');
});






Route::name('admin.')->prefix('admin')->controller(AllergyController::class)->middleware('web')->group(function () {

    Route::get('allergy_list', 'index')->name('allergy.list');

    Route::get('allergy_add', 'create')->name('allergy.add');

    Route::post('allergy_store', 'store')->name('allergy.store');

    Route::get('allergy_edit/{id}', 'edit')->name('allergy.edit');

    Route::post('allergy_update', 'update')->name('allergy.update');

    Route::delete('allergy_delete/{id}', 'delete')->name('allergy.delete');

    Route::get('allergy_status/{id}', 'status')->name('allergy.status');

});
Route::name('admin.')->prefix('admin')->controller(BloodGroupController::class)->middleware('web')->group(function () {

    Route::get('blood_group_list', 'index')->name('blood_group.list');

    Route::get('blood_group_add', 'create')->name('blood_group.add');

    Route::post('blood_group_store', 'store')->name('blood_group.store');

    Route::get('blood_group_edit/{id}', 'edit')->name('blood_group.edit');

    Route::post('blood_group_update', 'update')->name('blood_group.update');

    Route::delete('blood_group_delete/{id}', 'delete')->name('blood_group.delete');

    Route::get('blood_group_status/{id}', 'status')->name('blood_group.status');

});
Route::name('admin.')->prefix('admin')->controller(CategoryController::class)->middleware('web')->group(function () {

    Route::get('category_list', 'index')->name('category.list');

    Route::get('category_add', 'create')->name('category.add');

    Route::post('category_store', 'store')->name('category.store');

    Route::get('category_edit/{id}', 'edit')->name('category.edit');

    Route::post('category_update', 'update')->name('category.update');

    Route::delete('category_delete/{id}', 'delete')->name('category.delete');

    Route::get('category_status/{id}', 'status')->name('category.status');

});
Route::name('admin.')->prefix('admin')->controller(MembershipController::class)->middleware('web')->group(function () {

    Route::get('membership_list', 'index')->name('membership.list');

    Route::get('membership_add', 'create')->name('membership.add');

    Route::post('membership_store', 'store')->name('membership.store');

    Route::get('membership_edit/{id}', 'edit')->name('membership.edit');

    Route::post('membership_update', 'update')->name('membership.update');

    Route::delete('membership_delete/{id}', 'delete')->name('membership.delete');

    Route::get('membership_status/{id}', 'status')->name('membership.status');

});
Route::name('admin.')->prefix('admin')->controller(CMSController::class)->middleware('web')->group(function () {

    Route::get('cms_list', 'index')->name('cms.list');

    Route::get('cms_add', 'create')->name('cms.add');

    Route::post('cms_store', 'store')->name('cms.store');

    Route::get('cms_edit/{id}', 'edit')->name('cms.edit');

    Route::post('cms_update', 'update')->name('cms.update');

    Route::delete('cms_delete/{id}', 'delete')->name('cms.delete');

    Route::get('cms_status/{id}', 'status')->name('cms.status');

});
Route::name('admin.')->prefix('admin')->controller(ComplainsController::class)->middleware('web')->group(function () {
    Route::get('complains_list', 'index')->name('complains.list');
    Route::get('complains_edit/{id}', 'edit')->name('complains.edit');
    Route::post('complains_reply', 'reply')->name('complains.reply');
});
Route::name('admin.')->prefix('admin')->controller(VaccinationController::class)->middleware('web')->group(function () {
    Route::get('vaccination_list', 'index')->name('vaccination.list');
});
Route::name('admin.')->prefix('admin')->controller(TransictionListController::class)->middleware('web')->group(function () {
    Route::get('transiction_list', 'index')->name('transiction.list');
});
Route::name('admin.')->prefix('admin')->controller(LogsController::class)->middleware('web')->group(function () {
    Route::get('logs', 'index')->name('logs');
});
Route::name('admin.')->prefix('admin')->controller(BannerController::class)->middleware('web')->group(function () {
    Route::get('banner_list', 'index')->name('banner.list');
    Route::get('banner_add', 'create')->name('banner.add');
    Route::post('banner_store', 'store')->name('banner.store');
    Route::get('banner_edit/{id}', 'edit')->name('banner.edit');
    Route::post('banner_update', 'update')->name('banner.update');
    Route::delete('banner_delete/{id}', 'delete')->name('banner.delete');
    Route::get('banner_status/{id}', 'status')->name('banner.status');
});
