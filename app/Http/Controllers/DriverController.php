<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Driver;
use App\Models\BookingRequest;
use Duoneos\Larablend\Http\Controllers\LarablendCrudController;

class DriverController extends LarablendCrudController{

    public static function trip_history(){
        $drivers_history = BookingRequest::with('driver','carrier','vehicle.vehicle_brand','vehicle.vehicle_model','dropoff_address','pickup_address')->get();
        return view('drivers.history',['drivers_history' => $drivers_history]);
    }
    public static function employment_history(){
        // $drivers_history = DriverEmployment::with('driver','carrier')->get();
        // return view('drivers.employment_history',['drivers_history' => $drivers_history]);
        return view('drivers.employment_history');
    }

    public static function force_assign_view(){
        $trips = BookingRequest::with('carrier','vehicle.vehicle_brand','vehicle.vehicle_model')
        ->get();
        $drivers = Driver::all();
        return view('drivers.driver_force_assign')
        ->with('trips',$trips)
        ->with('drivers',$drivers);
    }
    public static function force_assign_trip_driver(Request $request, $model){
        dd($request);
    }

    public static function driver_with_AppNoapp(){
        $drivers_with_app = Driver::with('profile',)->where('token','!=',null)->get();
        $drivers_with_Noapp = Driver::with('profile')->where('token','=',null)->get();
        return view('drivers.with_app_no_app')
        ->with('drivers_with_app',$drivers_with_app)
        ->with('drivers_with_Noapp',$drivers_with_Noapp);
    }
}
