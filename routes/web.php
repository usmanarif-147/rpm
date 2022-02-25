<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
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

Route::get('/', [UserController::class, 'index'])->name('home');
Route::get('/contact', [UserController::class, 'contact'])->name('contact');
Route::view('/privacy-policy', 'user.privacy_policy')->name('privacy');
Route::view('/terms', 'user.terms')->name('terms');

/**
 * store vehicle data route
*/
Route::post('/store/vehicle', [UserController::class, 'storeVehicle'])->name('store.vehicle');

Route::get('/read-csv-file', function (){
    $csv_data = file('G:\repos\rpm-parking\vehicles.csv');
    $vehicles = array_slice($csv_data,1);

    foreach ($vehicles as $vehicle)
    {
        $vehicle = explode(',', $vehicle);
        \App\Models\User\Vehicle::create([
            'property_id' => $vehicle[1],
            'make' => $vehicle[2],
            'model' => $vehicle[3],
            'license' => $vehicle[4],
            'resident_name' => $vehicle[5],
            'apartment_no' => $vehicle[6],
            'email' => $vehicle[7],
            'valid_till' => ''
        ]);
    }

});

Auth::routes();
