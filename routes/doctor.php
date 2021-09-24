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

Route::group(['middleware' => 'auth:doctor', 'as' => 'doctor.', 'prefix' => 'doctor'], function () {
    Route::get('home', [DashboardController::class, 'doctorHome'])->name('home'); 
    Route::post('change-password', [DashboardController::class, 'changePassword'])->name('change-password');
    Route::post('/logout',function(){
        Auth::user()->update(['on_duty' => 0]);
        Auth::guard('doctor')->logout();
        return redirect()->action([
            LoginController::class,
            'login'
        ]);
    })->name('logout');

    //Patients Info
    Route::group(['prefix' => 'patient', 'as' => 'patient.'], function () {
        Route::get('', [PatientsController::class, 'nurseAccessPatient'])->name('home');
        Route::post('add-allergy', [PatientsController::class, 'addAllergyOrPhobia'])->name('add-allergy');

        Route::get('folders/{id}', [PatientsController::class, 'openFolders'])->name('folders');
        Route::get('folder/{id}', [PatientsController::class, 'openFolder'])->name('folder');

        Route::get('folder/file/{id}', [PatientsController::class, 'nurseEditFile'])->name('edit-file');
        Route::put('folder/file/{id}', [PatientsController::class, 'nurseUpdateFile'])->name('update-file');

        Route::get('new/folder/{id}', [PatientsController::class, 'nurseCreateFolder'])->name('new-folder');
    });

    //Settings
    Route::group(['prefix' => 'settings', 'as' => 'settings.'], function () {
        Route::get('', [SettingsController::class, 'doctorHome'])->name('home');
        Route::put('update', [SettingsController::class, 'updateDoctor'])->name('update');
    });
});