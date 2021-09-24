<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\PatientsController;
use App\Http\Controllers\SettingsController;

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

Route::get('/', function () {
    return redirect('login');
});

Route::get('login', [LoginController::class, 'login'])->name('login');
Route::post('login', [LoginController::class, 'authenticate'])->name('login');

Route::post('logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

Route::group(['middleware' => 'auth'], function () {
    Route::get('home', [DashboardController::class, 'home'])->name('home'); 
    Route::post('change-password', [DashboardController::class, 'changePassword'])->name('change-password');
    //Staff
    Route::group(['prefix' => 'staff', 'as' => 'staff.'], function () {
        Route::get('', [StaffController::class, 'home'])->name('home');
        //Doctors
        Route::group(['prefix' => 'doctors', 'as' => 'doctors.'], function () {
            Route::get('', [StaffController::class, 'viewDoctors'])->name('home');
            Route::get('add', [StaffController::class, 'addDoctor'])->name('add');
            Route::post('add', [StaffController::class, 'storeDoctor'])->name('store');
            Route::get('show/{id}', [StaffController::class, 'showDoctor'])->name('show');
            Route::put('show/{id}', [StaffController::class, 'updateDoctor'])->name('update');
        });
        //Pharmacists
        Route::group(['prefix' => 'pharmacists', 'as' => 'pharmacists.'], function () {
            Route::get('', [StaffController::class, 'viewPharmacists'])->name('home');
            Route::get('add', [StaffController::class, 'addPharmacist'])->name('add');
            Route::post('add', [StaffController::class, 'storePharmacist'])->name('store');
            Route::get('show/{id}', [StaffController::class, 'showPharmacist'])->name('show');
            Route::put('show/{id}', [StaffController::class, 'updatePharmacist'])->name('update');
        });
        //Nurses
        Route::group(['prefix' => 'nurses', 'as' => 'nurses.'], function () {
            Route::get('', [StaffController::class, 'viewNurses'])->name('home');
            Route::get('add', [StaffController::class, 'addNurse'])->name('add');
            Route::post('add', [StaffController::class, 'storeNurse'])->name('store');
            Route::get('show/{id}', [StaffController::class, 'showNurse'])->name('show');
            Route::put('show/{id}', [StaffController::class, 'updateNurse'])->name('update');
        });
    });
    //Medical Inventory
    Route::group(['prefix' => 'inventory', 'as' => 'inventory.'], function () {
        Route::get('', [InventoryController::class, 'home'])->name('home');
        Route::post('add', [InventoryController::class, 'addDrug'])->name('add');
    });
    //Patients Info
    Route::group(['prefix' => 'patient', 'as' => 'patient.'], function () {
        Route::get('', [PatientsController::class, 'home'])->name('home');
        Route::post('add', [PatientsController::class, 'addPatient'])->name('add');
        Route::get('access', [PatientsController::class, 'accessPatient'])->name('access');
        Route::get('folders/{id}', [PatientsController::class, 'openFolders'])->name('folders');
        Route::get('folder/{id}', [PatientsController::class, 'openFolder'])->name('folder');
    });
    //Settings
    Route::group(['prefix' => 'settings', 'as' => 'settings.'], function () {
        Route::get('', [SettingsController::class, 'home'])->name('home');
        Route::put('update-hospital', [SettingsController::class, 'updateHospital'])->name('update-hospital');
        Route::put('update-root-user', [SettingsController::class, 'updateRootUser'])->name('update-root-user');
    });
});

// Route::group(['middleware' => 'auth:doctor', 'prefix' => 'doctor', 'as' => 'doctors.'], function () {
//     Route::get('home', [DashboardController::class, 'home'])->name('home'); 
//     Route::post('change-password', [DashboardController::class, 'changePassword'])->name('change-password');
// });