<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CarrierRequest;
use Duoneos\Larablend\Http\Controllers\LarablendCrudController;

class CarrierRequestController extends LarablendCrudController{
    
    public static function status(){
        $carrierRequests = CarrierRequest::with('carrier','timeline','status')->get();
        //status function here is performing left join with timelines in carrierReques model
        return view('carrierRequest.status',['carrierRequests' => $carrierRequests]);
    }
}
