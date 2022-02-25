<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Driver\DriverLoginController;
use App\Http\Controllers\Driver\DriverController;
use App\Http\Controllers\Driver\DriverForgotPasswordController;
use App\Http\Controllers\Driver\DriverResetPasswordController;
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

Route::prefix('/driver/')->group(function(){
    Route::get('login',[DriverLoginController::class, 'showLoginForm'])->name('driver.login.form');
    Route::post('login',[DriverLoginController::class, 'login'])->name('driver.submit.login');
    Route::post('logout',[DriverLoginController::class, 'logout'])->name('driver.logout');

    Route::get('password/reset',[DriverForgotPasswordController::class, 'showLinkRequestForm'])
        ->name('driver.password.request');
    Route::post('password/email',[DriverForgotPasswordController::class, 'sendResetLinkEmail'])
        ->name('driver.password.email');
    Route::get('password/reset/{token}',[DriverResetPasswordController::class, 'showResetForm'])
        ->name('driver.password.reset');
    Route::post('password/reset',[DriverResetPasswordController::class, 'reset'])
        ->name('driver.password.update');
    
    Route::get('dashboard',[DriverController::class, 'index'])->name('driver.dashboard');
});


