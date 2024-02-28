<?php

use App\Exports\FormDataExport;
use App\Exports\FormAttributeExport;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\indexController;
use App\Http\Controllers\ExportController;
// use App\Http\Controllers\ageGroupController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\Data\FormController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
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

Route::get('/', [indexController::class, 'index'])->name('index');
// Route::get('/home',  [HomeController::class, 'index'])->name('home');

// Route::post('admin_registration', [RegisterController::class, 'create'])->name('register');
// Route::get('admin_registration', [RegisterController::class, 'show_admin_registration'])->name('admin_registration');
Route::get('login', [LoginController::class, 'show_login'])->name('login');
Route::post('authenticate', [LoginController::class, 'authenticate'])->name('authenticate');

// Route::middleware(['auth', 'role:admin' ])->prefix('admin')->group(function() {

// Route::get('users/export', [ExportController::class, 'export'])->name('user.export');
// Route::get('formdata/export/{range}', [ExportController::class, 'formdata'])->name('formdata.export');
// Route::get('formattribute/export', [ExportController::class, 'formattribute'])->name('formattribute.export');
// Route::get('form/export/{keywords}/{startDate}/{endDate}', [ExportController::class, 'form'])->name('form.export');
// Route::get('field_data/export/{keywords}/{submission_status}/{startDate}/{endDate}', [ExportController::class, 'fieldData'])->name('field_data.export');
// Route::get('reginal_report/export/{region_id}/{startDate}/{endDate}', [ExportController::class, 'reginalReport'])->name('reginal_report.export');
// Route::get('formdata/{formdata_id}', [ExportController::class, 'formOne'])->name('formOne.export');
// Route::get('single_field_data/{form_id}', [ExportController::class, 'singleFormData'])->name('singleFormData.export');
// Route::get('dataformsapi', [FormController::class, 'index'])->name('dataformsapi');

Route::middleware(['auth'])->group(function() {

    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('my_profile', [LoginController::class, 'userProfile'])->name('user.profile');

    Route::get('change_password', [LoginController::class, 'changePassword'])->name('user.change_password');

    Route::get('dashboard', [adminController::class, 'dashboard'])->name('admin.dashboard');

    Route::get('administrators', [adminController::class, 'admins'])->name('admin.admins')->middleware(['permission:all admins']);

    Route::get('add_admin', [adminController::class, 'addAdmin'])->name('admin.add_admin')->middleware(['permission:add admin']);

    Route::get('admins/{admin_id}/edit', [adminController::class, 'editAdmin'])->name('admin.edit_admin')->middleware(['permission:edit admin']);

    Route::get('deleted_admins', [adminController::class, 'deactivatedAdmins'])->name('admin.deactivated.admins')->middleware(['permission:all deleted admins']);

    Route::get('all_staffs', [adminController::class, 'staffs'])->name('admin.staffs')->middleware(['permission:all staffs']);

    Route::get('deleted_staffs', [adminController::class, 'deactivatedStaffs'])->name('admin.deactivated.staffs')->middleware(['permission:all deleted staffs']);

    Route::get('add_staff', [adminController::class, 'addStaff'])->name('admin.add_staff')->middleware(['permission:add staff']);

    Route::get('staffs/{staff_id}/edit', [adminController::class, 'editStaff'])->name('admin.edit_staff')->middleware(['permission:edit staff']);

    Route::get('regions', [adminController::class, 'regions'])->name('admin.regions');
    // ->middleware(['permission:all age groups']);

    Route::get('districts', [adminController::class, 'districts'])->name('admin.districts');
    // ->middleware(['permission:all age groups']);

    Route::get('wards', [adminController::class, 'wards'])->name('admin.wards');
    // ->middleware(['permission:all age groups']);wards

    Route::get('age_groups', [adminController::class, 'ageGroups'])->name('admin.age_groups')->middleware(['permission:all age groups']);

    Route::get('attributes/list', [adminController::class, 'attributes'])->name('admin.attributes')->middleware(['permission:all attributes']);

    Route::get('form_attributes', [adminController::class, 'formAttributes'])->name('admin.form_attributes')->middleware(['permission:all form attributes']);

    Route::get('form_attributes/add', [adminController::class, 'addFormAttributes'])->name('admin.add_form_attributes')->middleware(['permission:add form attribute']);

    Route::get('form_attributes/{form_id}/edit', [adminController::class, 'editFormAttributes'])->name('admin.edit_form_attributes')->middleware(['permission:edit form attribute']);

    Route::get('create_form/{form_attributes_id}', [adminController::class, 'createForm'])->name('admin.create_form')->middleware(['permission:all deleted admins']);

    Route::get('form_data/create', [adminController::class, 'createFormData'])->name('admin.create_form_data')->middleware(['permission:add field data']);

    Route::get('form_data/{form_id}/edit', [adminController::class, 'editFormData'])->name('admin.edit_form_data')->middleware(['permission:edit field data']);

    Route::get('filed_data', [adminController::class, 'reportList'])->name('admin.report')->middleware(['permission:all field data']);

    Route::get('filed_data/{form}', [adminController::class, 'reportListComment'])->name('admin.report.comment')->middleware(['permission:all field data']);

    Route::get('reports', [adminController::class, 'report'])->name('admin.reporting')->middleware(['permission:all reports']);

    Route::get('reports/{form}/view', [adminController::class, 'viewReport'])->name('admin.reporting.view');
    // ->middleware(['permission:all reports']);

    Route::get('reports/{report}', [adminController::class, 'reportComment'])->name('admin.reporting.comment')->middleware(['permission:all reports']);

    Route::get('roles', [adminController::class, 'roles'])->name('admin.roles')->middleware(['permission:all roles']);

    Route::get('permissions', [adminController::class, 'permissions'])->name('admin.permissions')->middleware(['permission:all permissions']);

    Route::get('permissions_to_roles', [adminController::class, 'permissionsToRoles'])->name('admin.permissions.roles')->middleware(['permission:roles with permissions']);

    Route::get('permissions_to_roles/add', [adminController::class, 'addPermissionsToRole'])->name('admin.add.permissions.role')->middleware(['permission:assign permissions to role']);

    Route::get('permissions_to_roles/{role_id}/edit', [adminController::class, 'editPermissionsToRole'])->name('admin.edit.permissions.role')->middleware(['permission:edit assigned permissions to role']);


    // Report download routes
    
    Route::get('users/export', [ExportController::class, 'export'])->name('user.export');
    
    Route::get('formdata/export/{range}', [ExportController::class, 'formdata'])->name('formdata.export');
    
    Route::get('formattribute/export', [ExportController::class, 'formattribute'])->name('formattribute.export');
    
    Route::get('form/export/{keywords}/{startDate}/{endDate}', [ExportController::class, 'form'])->name('form.export');
    
    Route::get('field_data/export/{keywords}/{submission_status}/{startDate}/{endDate}', [ExportController::class, 'fieldData'])->name('field_data.export');
    
    Route::get('reginal_report/export/{region_id}/{startDate}/{endDate}', [ExportController::class, 'reginalReport'])->name('reginal_report.export');
    
    Route::get('formdata/{formdata_id}', [ExportController::class, 'formOne'])->name('formOne.export');
    
    Route::get('single_field_data/{form_id}', [ExportController::class, 'singleFormData'])->name('singleFormData.export');
    
    Route::get('dataformsapi', [FormController::class, 'index'])->name('dataformsapi');


});