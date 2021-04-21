<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CarrierRequest;
use App\Models\Status;
use Duoneos\Larablend\Http\Controllers\LarablendCrudController;

class CarrierRequestController extends LarablendCrudController{
    
    public static function status(){
        $carrierRequests = CarrierRequest::with('carrier')
        ->join('timelines','carrier_requests.timeline_id','=','timelines.id')
        ->join('statuses','timelines.status_id','=','statuses.id')
        ->get();
        //status function here is performing left join with timelines in carrierReques model
        return view('carrierRequest.status',['carrierRequests' => $carrierRequests]);
    }
    public static function editStatus($model, $id){
        // $carrierRequest = CarrierRequest::with('carrier','timeline','status')->where('id',$id)->first();
        $carrierRequest = CarrierRequest::with('carrier')
        ->join('timelines','carrier_requests.timeline_id','=','timelines.id')
        ->join('statuses','timelines.status_id','=','statuses.id')
        ->where('carrier_requests.id',$id)
        ->first();
        $statuses = Status::all();
        return view('carrierRequest.statusEdit',['carrierRequest' => $carrierRequest,'statuses' => $statuses]);
    }
}
