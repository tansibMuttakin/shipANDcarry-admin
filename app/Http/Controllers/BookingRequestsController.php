<?php

namespace App\Http\Controllers;

use App\Models\BookingRequest;
use App\Models\BookingRequestCarrier;
use App\Models\BookingRequestVehicle;
use App\Models\Vehicle;
use App\Models\Status;
use App\Models\VehicleType;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Duoneos\Larablend\Http\Controllers\LarablendCrudController;

class BookingRequestsController extends LarablendCrudController
{
    public static function filter_carrier(Request $request, $model, $api, $id){
        $booking_request = BookingRequest::findOrFail($id);
        $weight_category_id = $booking_request->weight_category_id;
        $goods_type_id = $booking_request->goods_type_id;
        $length = $booking_request->length ? $booking_request->length : 0;
        $weight = $booking_request->weight;
        $trip_vehicle_types = $booking_request->trip_vehicle_types;
        $vehicle_type_ids = [];
        foreach($trip_vehicle_types as $trip_vehicle_type){
            array_push($vehicle_type_ids, $trip_vehicle_type->vehicle_type->id);
        }
        // Convert user input weight to ton from kg
        if(strtolower($booking_request->weight_unit) == 'kg'){
            $weight = $weight / 1000;
        }
        $eligible_vehicles = Vehicle::where('weight_category_id', $weight_category_id)->whereIn('vehicle_type_id', $vehicle_type_ids)->where('weight_taken_ignore', '>=', $weight)->where('body_length_ignore', '>=', $length)->get();
        $carrier_ids = [];
        foreach ($eligible_vehicles as $eligible_vehicle){
            $booking_request_carrier = BookingRequestCarrier::where('booking_request_id', $id)->where('carrier_id', $eligible_vehicle->carrier_id)->first();
            $booking_request_vehicle = BookingRequestVehicle::where('vehicle_id', $eligible_vehicle->id)->where('booking_request_id', $id)->first();
            if(!$booking_request_vehicle){
                $booking_request_vehicle = new BookingRequestVehicle();
                $booking_request_vehicle->vehicle_id = $eligible_vehicle->id;
                $booking_request_vehicle->booking_request_id = $id;
                $booking_request_vehicle->save();
            }
            array_push($carrier_ids, $eligible_vehicle->carrier_id);
            if($booking_request_carrier){
                continue;
            }
            $booking_request_carrier = new BookingRequestCarrier();
            $booking_request_carrier->booking_request_id = $id;
            $booking_request_carrier->carrier_id = $eligible_vehicle->carrier_id;
            $booking_request_carrier->save();
        }
        $response = self::generate_response($model);
        $response->data = $carrier_ids;
        return response()->json($response);
    }
    public static function carriers(Request $request, $model, $api, $id)
    {
        $booking_request = BookingRequest::findOrFail($id);
        $carriers = $booking_request->carriers;
        dd($carriers);
    }
    public static function filter_carriers(Request $request, $model, $api)
    {
        $bookings = BookingRequest::all();
        foreach ($bookings as $booking){
            self::filter_carrier($request, $model, $api, $booking->id);
        }
        return "Done";
    }

    //Store eligible vehicles
    public static function eligible_vehicles(Request $request, $model, $api, $id)
    {
        $booking_request = BookingRequest::findOrFail($id);
        $response = self::generate_response($model);
        $response->entry_keys = self::model_to_entry_keys("App\\Models\\Vehicle");
        $new_data = [];
        foreach($booking_request->eligible_vehicles as $entry){
            $newObject = new \stdClass();
            $newObject->id = $entry->id;
            foreach($response->entry_keys as $key){
                if(Str::contains($key, '_datetime')){
                    $newObject->$key = Carbon::parse($entry->$key)->format('Y/m/d h:i A');
                }else if(Str::contains($key, '_date')){
                    $newObject->$key = Carbon::parse($entry->$key)->format('Y/m/d');
                }else{
                    $newObject->$key = $entry->$key;
                }
            }
            array_push($new_data, $newObject);
        }
        $response->data = $new_data;
        return response()->json($response);
    }

    public static function status(){
        $bookingRequests = BookingRequest::with('carrier','shipper','driver','request_status')
        ->get();
        return view('bookingRequest.status',['bookingRequests' => $bookingRequests]);
    }
    public static function editStatus($model, $id){
        // $carrierRequest = CarrierRequest::with('carrier','timeline','status')->where('id',$id)->first();
        $bookingRequest = BookingRequest::with('carrier','shipper','driver','request_status')
        ->where('id',$id)->first();
        $statuses = Status::all();
        return view('bookingRequest.statusEdit',['bookingRequest' => $bookingRequest,'statuses' => $statuses]);
    }
    public static function updateStatus(Request $request,$model, $id){
        // $carrierRequest = CarrierRequest::with('carrier','timeline','status')->where('id',$id)->first();
        $bookingRequest = BookingRequest::find($id);
        $bookingRequest->request_status_id_status = $request->status_id;
        $bookingRequest->save();
        return redirect('/dashboard/booking_request/status')->with('message','Booking request status updated');
    }
}
