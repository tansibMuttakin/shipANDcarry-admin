<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Driver;
use App\Models\BookingRequest;
use Duoneos\Larablend\Http\Controllers\LarablendCrudController;

class DriverController extends LarablendCrudController{

    public static function history(){
        $drivers = Driver::all();
        $bookings = BookingRequest::all();
        return view('drivers.history',['drivers' => $drivers,'bookings' => $bookings]);
    }
}
