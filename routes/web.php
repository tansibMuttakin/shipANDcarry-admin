<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('dashboard')->group(function () {
    Route::get('/', function(){
        // shippers
        $shippers = App\Models\Shipper::orderBy('created_at','desc')->get();
        $shippers_company = App\Models\Shipper::where('type','company')->get();
        $shippers_individual = App\Models\Shipper::where('type','individual')->get();
        $shippers_active = App\Models\Shipper::leftJoin('profiles','shippers.profile_id','profiles.id')->where('active',1)->get();
        $shippers_inactive = App\Models\Shipper::leftJoin('profiles','shippers.profile_id','profiles.id')->where('active',0)->get();
        $shippers_data = new \stdClass();
        $shippers_data->shippers = $shippers;
        $shippers_data->shippers_company = $shippers_company;
        $shippers_data->shippers_individual = $shippers_individual;
        $shippers_data->shippers_active = $shippers_active;
        $shippers_data->shippers_inactive = $shippers_inactive;
    

        //carriers
        $carriers = App\Models\Carrier::orderBy('created_at','desc')->get();
        $carriers_individual = App\Models\Carrier::where('type','individual')->get();
        $carriers_company = App\Models\Carrier::where('type','comapany')->get();
        $carriers_data = new \stdClass();
        $carriers_data->carriers = $carriers;
        $carriers_data->carriers_individual = $carriers_individual;
        $carriers_data->carriers_company = $carriers_company;

        //driver
        $drivers = App\Models\Driver::orderBy('created_at','desc')->get();

        //vehicles
        $vehicles = App\Models\Vehicle::orderBy('created_at','desc')->get();


        return view('dashboard')
        ->with('shippers_data',$shippers_data)
        ->with('carriers_data',$carriers_data)
        ->with('drivers',$drivers)
        ->with('vehicles',$vehicles);
    });
});
Route::get('/shippers-history', function () {
    return view('shippers.history');
});