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

Route::group(['middleware' => 'auth:pharmacist', 'as' => 'pharmacist.', 'prefix' => 'pharmacist'], function () {
    Route::get('home', [DashboardController::class, 'home'])->name('home'); 
    Route::post('change-password', [DashboardController::class, 'changePassword'])->name('change-password');
    Route::post('/logout',function(){
        Auth::guard('pharmacist')->logout();
        return redirect()->action([
            LoginController::class,
            'login'
        ]);
    })->name('logout');
});