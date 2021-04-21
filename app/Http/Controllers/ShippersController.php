<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookingRequest;
use App\Models\Shipper;
use App\Models\Profile;

use Duoneos\Larablend\Http\Controllers\LarablendCrudController;

class ShippersController extends LarablendCrudController
{
    public static function history(){
        $bookings = BookingRequest::all();
        return view('shippers.history',['bookings' => $bookings]);
    }
    public static function status(){
        $shippers = Shipper::all();
        return view('shippers.status',['shippers' => $shippers]);
    }
    public static function statusDisapprove($model, $id){
        $profile = Profile::findOrfail($id);
        $profile->active = 0;
        $profile->save();
        return redirect()->back()->with('message','Status Updated');
    }
    public static function statusApprove($model, $id){
        $profile = Profile::findOrfail($id);
        $profile->active = 1;
        $profile->save();
        return redirect()->back()->with('message','Status Updated');
    }
}
