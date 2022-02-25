<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PropertyController;
use App\Http\Controllers\Admin\ManageUsersController;
use App\Http\Controllers\Admin\PermitController;
use App\Http\Controllers\Admin\AdminForgotPasswordController;
use App\Http\Controllers\Admin\AdminResetPasswordController;
use App\Http\Controllers\Admin\AdminSettingsController;
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


Route::prefix('/admin/')->group(function (){

    Route::get('login',[AdminLoginController::class, 'showLoginForm'])->name('admin.login.form');
    Route::post('login',[AdminLoginController::class, 'login'])->name('admin.submit.login');
    Route::post('logout',[AdminLoginController::class, 'logout'])->name('admin.logout');
    Route::get('change-password',[AdminSettingsController::class, 'changePasswordForm'])
        ->name('admin.change.password');
    Route::post('update-password',[AdminSettingsController::class, 'updateNewPassword'])
        ->name('admin.update.password');

    Route::get('password/reset',[AdminForgotPasswordController::class, 'showLinkRequestForm'])
        ->name('admin.password.request');
    Route::post('password/email',[AdminForgotPasswordController::class, 'sendResetLinkEmail'])
        ->name('admin.password.email');
    Route::get('password/reset/{token}',[AdminResetPasswordController::class, 'showResetForm'])
        ->name('admin.password.reset');
    Route::post('password/reset',[AdminResetPasswordController::class, 'reset'])
        ->name('admin.password.update');


    Route::get('dashboard',[AdminController::class, 'index'])->name('admin.dashboard');
    Route::post('all-vehicles',[AdminController::class, 'allVehiclesAjax'])->name('admin.vehicles.ajax');


    /**
     * property rotes
     */
    Route::get('properties', [PropertyController::class, 'index'])->name('admin.properties');
    Route::post('active-properties', [PropertyController::class, 'activePropertiesAjax'])
        ->name('admin.active.properties.ajax');
    Route::get('deactivated-properties', [PropertyController::class, 'deactivatedProperties'])
        ->name('admin.deactivated.properties');
    Route::post('deactivated-properties', [PropertyController::class, 'deactivatedPropertiesAjax'])
        ->name('admin.deactivated.properties.ajax');
    Route::post('create-property', [PropertyController::class, 'createProperty'])->name('admin.create.property');
    Route::get('edit-property/{id}', [PropertyController::class, 'editProperty'])->name('admin.edit.property');
    Route::post('update-property', [PropertyController::class, 'updateProperty'])->name('admin.update.property');
    Route::post('deactivate-property/{id}', [PropertyController::class, 'deactivateProperty'])
        ->name('admin.deactivate.property');
    Route::post('activate-property/{id}', [PropertyController::class, 'activateProperty'])
        ->name('admin.activate.property');

    /**
     * manager rotes
     */
    Route::get('managers', [ManageUsersController::class, 'managers'])->name('admin.managers');
    Route::post('all-managers', [ManageUsersController::class, 'allManagersAjax'])->name('admin.managers.ajax');
    Route::post('create-manager', [ManageUsersController::class, 'createManager'])->name('admin.create.manager');
    Route::get('edit-manager/{id}', [ManageUsersController::class, 'editManager'])->name('admin.edit.manager');
    Route::put('update-manager', [ManageUsersController::class, 'updateManager'])->name('admin.update.manager');
    Route::post('delete-manager/{id}', [ManageUsersController::class, 'deleteManager'])
        ->name('admin.delete.manager');

    /**
     * driver rotes
     */
    Route::get('drivers', [ManageUsersController::class, 'drivers'])->name('admin.drivers');
    Route::post('all-drivers', [ManageUsersController::class, 'allDriversAjax'])->name('admin.drivers.ajax');
    Route::post('create-driver', [ManageUsersController::class, 'createDriver'])->name('admin.create.driver');
    Route::get('edit-driver/{id}', [ManageUsersController::class, 'editDriver'])->name('admin.edit.driver');
    Route::put('update-driver', [ManageUsersController::class, 'updateDriver'])->name('admin.update.driver');
    Route::post('delete-driver/{id}', [ManageUsersController::class, 'deleteDriver'])
        ->name('admin.delete.driver');

    /**
     * permit rotes
     */
    Route::get('active-permits', [PermitController::class, 'activePermits'])
        ->name('admin.active.permits');
    Route::post('active-permits', [PermitController::class, 'activePermitsAjax'])
        ->name('admin.active.permits.ajax');
    Route::get('expired-permits', [PermitController::class, 'expiredPermits'])
        ->name('admin.expired.permits');
    Route::post('expired-permits', [PermitController::class, 'expiredPermitsAjax'])
        ->name('admin.expired.permits.ajax');
});


