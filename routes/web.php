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

Route::get('/rc/dashboard', function () {
    return view('customer.index');
})->name('home');

Route::get('/', [indexController::class, 'index'])->name('index');
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('login', [LoginController::class, 'show_login'])->name('login');
Route::post('authenticate', [LoginController::class, 'authenticate'])->name('authenticate');

Route::group(['middleware' => 'auth'], function() {

    //admin
    Route::group(['prefix' => 'admin'], function() {
        Route::post('logout', [LoginController::class, 'logout'])->name('logout');

        Route::get('dashboard', [dashboardController::class, 'dashboard'])->name('admin.dashboard');

        Route::get('age_groups', [adminController::class, 'ageGroups'])->name('admin.age_groups');

        Route::get('attributes', [adminController::class, 'attributes'])->name('admin.attributes');

        Route::get('form_attributes', [adminController::class, 'formAttributes'])->name('admin.form_attributes');

        Route::get('form_attributes/add', [adminController::class, 'addFormAttributes'])->name('admin.add_form_attributes');
        Route::get('form_attributes/{form_id}/edit', [adminController::class, 'editFormAttributes'])->name('admin.edit_form_attributes');

    });

    // //regional coordinator
    // Route::group(['prefix' => 'rc'], function() {
    //     Route::post('logout', [LoginController::class, 'logout'])->name('logout1');

    //     Route::get('dashboard', [dashboardController::class, 'dashboard'])->name('admin.dashboard');

    //     Route::get('age_groups', [adminController::class, 'ageGroups'])->name('admin.age_groups');

    //     Route::get('attributes', [adminController::class, 'attributes'])->name('admin.attributes');

    //     Route::get('form_attributes', [adminController::class, 'formAttributes'])->name('admin.form_attributes');

    //     Route::get('form_attributes/add', [adminController::class, 'addFormAttributes'])->name('admin.add_form_attributes');

    // });


    //     //Amref
    //     Route::group(['prefix' => 'amref'], function() {
    //         Route::post('logout', [LoginController::class, 'logout'])->name('logout2');

    //         Route::get('dashboard', [dashboardController::class, 'dashboard'])->name('admin.dashboard');

    //         Route::get('age_groups', [adminController::class, 'ageGroups'])->name('admin.age_groups');

    //         Route::get('attributes', [adminController::class, 'attributes'])->name('admin.attributes');

    //         Route::get('form_attributes', [adminController::class, 'formAttributes'])->name('admin.form_attributes');

    //         Route::get('form_attributes/add', [adminController::class, 'addFormAttributes'])->name('admin.add_form_attributes');

    //     });


    //         //Health Facilitator
    // Route::group(['prefix' => 'health'], function() {
    //     Route::post('logout', [LoginController::class, 'logout'])->name('logout3');

    //     Route::get('dashboard', [dashboardController::class, 'dashboard'])->name('admin.dashboard');

    //     Route::get('age_groups', [adminController::class, 'ageGroups'])->name('admin.age_groups');

    //     Route::get('attributes', [adminController::class, 'attributes'])->name('admin.attributes');

    //     Route::get('form_attributes', [adminController::class, 'formAttributes'])->name('admin.form_attributes');

    //     Route::get('form_attributes/add', [adminController::class, 'addFormAttributes'])->name('admin.add_form_attributes');

    // });

});


