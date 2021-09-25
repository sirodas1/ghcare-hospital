<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\PatientsController;
use App\Http\Controllers\SettingsController;
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
    Route::get('home', [DashboardController::class, 'pharmacistHome'])->name('home'); 
    Route::post('change-password', [DashboardController::class, 'changePassword'])->name('change-password');
    Route::post('/logout',function(){
        Auth::user()->update(['on_duty' => 0]);
        Auth::guard('pharmacist')->logout();
        return redirect()->action([
            LoginController::class,
            'login'
        ]);
    })->name('logout');

    //Medications
    Route::group(['prefix' => 'medication', 'as' => 'medication.'], function () {
        Route::get('', [InventoryController::class, 'medicationhome'])->name('home');
        Route::get('issue/{id}', [InventoryController::class, 'issueDrug'])->name('issue');
    });

    //Medical Inventory
    Route::group(['prefix' => 'inventory', 'as' => 'inventory.'], function () {
        Route::get('', [InventoryController::class, 'home'])->name('home');
        Route::post('add', [InventoryController::class, 'addDrug'])->name('add');
    });

    //Settings
    Route::group(['prefix' => 'settings', 'as' => 'settings.'], function () {
        Route::get('', [SettingsController::class, 'pharmacistHome'])->name('home');
        Route::put('update', [SettingsController::class, 'updatePharmacist'])->name('update');
    });
});