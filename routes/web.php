<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\indexController;
use App\Http\Controllers\ageGroupController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\Auth\LoginController;

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
Route::get('/home',  [HomeController::class, 'index'])->name('home');

Route::get('login', [LoginController::class, 'show_login'])->name('login');
Route::post('authenticate', [LoginController::class, 'authenticate'])->name('authenticate');

// Route::middleware(['auth', 'role:admin' ])->prefix('admin')->group(function() {

Route::middleware(['auth'])->group(function() {

    //admin
    Route::group(['prefix' => 'admin'],function() {

        Route::post('logout', [LoginController::class, 'logout'])->name('logout');

        Route::get('dashboard', [dashboardController::class, 'dashboard'])->name('admin.dashboard');

        Route::get('admins', [adminController::class, 'admins'])->name('admin.admins');
        
        Route::get('add_admin', [adminController::class, 'addAdmin'])->name('admin.add_admin');

        Route::get('admins/{admin_id}/edit', [adminController::class, 'editAdmin'])->name('admin.edit_admin');

        Route::get('staffs', [adminController::class, 'staffs'])->name('admin.staffs');
        
        Route::get('add_staff', [adminController::class, 'addStaff'])->name('admin.add_staff');

        Route::get('staffs/{staff_id}/edit', [adminController::class, 'editStaff'])->name('admin.edit_staff');

        Route::get('age_groups', [adminController::class, 'ageGroups'])->name('admin.age_groups');

        Route::get('attributes', [adminController::class, 'attributes'])->name('admin.attributes');

        Route::get('form_attributes', [adminController::class, 'formAttributes'])->name('admin.form_attributes');

        Route::get('form_attributes/add', [adminController::class, 'addFormAttributes'])->name('admin.add_form_attributes');

        Route::get('form_attributes/{form_id}/edit', [adminController::class, 'editFormAttributes'])->name('admin.edit_form_attributes');

        Route::get('create_form/{form_attributes_id}', [adminController::class, 'createForm'])->name('admin.create_form');

        Route::get('form_data/{form_id}/edit', [adminController::class, 'editFormData'])->name('admin.edit_form_data');
        
        Route::get('form_data/create', [adminController::class, 'createFormData'])->name('admin.create_form_data');

        Route::get('report/list', [adminController::class, 'reportList'])->name('admin.report');

        Route::get('roles', [adminController::class, 'roles'])->name('admin.roles');

        Route::get('permissions', [adminController::class, 'permissions'])->name('admin.permissions');

        Route::get('permissions_to_roles', [adminController::class, 'permissionsToRoles'])->name('admin.permissions.roles');

        Route::get('permissions_to_roles/add', [adminController::class, 'addPermissionsToRole'])->name('admin.add.permissions.role');

        Route::get('permissions_to_roles/{role_id}/edit', [adminController::class, 'editPermissionsToRole'])->name('admin.edit.permissions.role');

    });


    //regional coordinator
    Route::group(['prefix' => 'rc'], function() {

        Route::post('logout', [LoginController::class, 'logout'])->name('logout1');

        Route::get('dashboard', [dashboardController::class, 'dashboard'])->name('admin.dashboard');

        Route::get('age_groups', [adminController::class, 'ageGroups'])->name('admin.age_groups');

        Route::get('attributes', [adminController::class, 'attributes'])->name('admin.attributes');

        Route::get('form_attributes', [adminController::class, 'formAttributes'])->name('admin.form_attributes');

        Route::get('form_attributes/add', [adminController::class, 'addFormAttributes'])->name('admin.add_form_attributes');

    });


        //Amref
    Route::group(['prefix' => 'amref'], function() {

        Route::post('logout', [LoginController::class, 'logout'])->name('logout2');

        Route::get('dashboard', [dashboardController::class, 'dashboard'])->name('admin.dashboard');

        Route::get('age_groups', [adminController::class, 'ageGroups'])->name('admin.age_groups');

        Route::get('attributes', [adminController::class, 'attributes'])->name('admin.attributes');

        Route::get('form_attributes', [adminController::class, 'formAttributes'])->name('admin.form_attributes');

        Route::get('form_attributes/add', [adminController::class, 'addFormAttributes'])->name('admin.add_form_attributes');

    });


    //Health Facilitator
    Route::group(['prefix' => 'health'], function() {

        Route::post('logout', [LoginController::class, 'logout'])->name('logout3');

        Route::get('dashboard', [dashboardController::class, 'dashboard'])->name('admin.dashboard');

        Route::get('age_groups', [adminController::class, 'ageGroups'])->name('admin.age_groups');

        Route::get('attributes', [adminController::class, 'attributes'])->name('admin.attributes');

        Route::get('form_attributes', [adminController::class, 'formAttributes'])->name('admin.form_attributes');

        Route::get('form_attributes/add', [adminController::class, 'addFormAttributes'])->name('admin.add_form_attributes');

    });

});
