<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Manager\ManagerLoginController;
use App\Http\Controllers\Manager\ManagerController;
use App\Http\Controllers\Manager\ManagerForgotPasswordController;
use App\Http\Controllers\Manager\ManagerResetPasswordController;
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


Route::prefix('/manager/')->group(function(){
    Route::get('login',[ManagerLoginController::class, 'showLoginForm'])->name('manager.login.form');
    Route::post('login',[ManagerLoginController::class, 'login'])->name('manager.submit.login');
    Route::post('logout',[ManagerLoginController::class, 'logout'])->name('manager.logout');
    Route::get('password/reset',[ManagerForgotPasswordController::class, 'showLinkRequestForm'])
        ->name('manager.password.request');
    Route::post('password/email',[ManagerForgotPasswordController::class, 'sendResetLinkEmail'])
        ->name('manager.password.email');
    Route::get('password/reset/{token}',[ManagerResetPasswordController::class, 'showResetForm'])
        ->name('manager.password.reset');
    Route::post('password/reset',[ManagerResetPasswordController::class, 'reset'])
        ->name('manager.password.update');

    Route::get('dashboard',[ManagerController::class, 'index'])->name('manager.dashboard');
    Route::post('vehicles',[ManagerController::class, 'getVehiclesAjax'])->name('manager.vehicles.ajax');
    Route::post('vehicle-details',[ManagerController::class, 'getVehicleDetailsAjax'])->name('manager.vehicle.details.ajax');
});

