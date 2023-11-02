<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\indexController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\dashboardController;

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

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();
Route::get('index', [App\Http\Controllers\indexController::class, 'index'])->name('index');
Route::get('/home', [App\Http\Controllers\HomeControauthenticateller::class, 'index'])->name('home');

Route::get('login', [LoginController::class, 'show_login'])->name('login');
Route::post('authenticate', [LoginController::class, 'authenticate'])->name('authenticate');

Route::group(['middleware' => 'auth'], function() {

    //admin
    Route::group(['prefix' => 'admin'], function() {
        Route::post('logout', [LoginController::class, 'logout'])->name('logout');

        Route::get('dashboard', [App\Http\Controllers\dashboardController::class, 'dashboard'])->name('admin.dashboard');

    });


});

