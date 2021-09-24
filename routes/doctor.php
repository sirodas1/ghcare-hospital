<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\PatientsController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::post('logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

Route::group(['middleware' => 'auth:doctor', 'as' => 'doctor.', 'prefix' => 'doctor'], function () {
    Route::get('home', [DashboardController::class, 'home'])->name('home'); 
    Route::post('change-password', [DashboardController::class, 'changePassword'])->name('change-password');
    Route::post('/logout',function(){
        Auth::guard('doctor')->logout();
        return redirect()->action([
            LoginController::class,
            'login'
        ]);
    })->name('logout');
});