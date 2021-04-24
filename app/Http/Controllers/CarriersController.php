<?php

namespace App\Http\Controllers;

use App\Models\AirFilterCleaning;
use App\Models\BookingRequest;
use App\Models\EngineOil;
use App\Models\OilFilter;
use App\Models\FuelFilter;
use App\Models\Fuel;
use App\Models\AirFilter;
use App\Models\TirePressure;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use App\Models\Carrier;
use Illuminate\Support\Str;
use Duoneos\Larablend\Http\Controllers\LarablendCrudController;

class CarriersController extends LarablendCrudController
{
    public static function withoutTruck_WithoutDriver(){
        $carriers_without_driver = Carrier::leftJoin('booking_requests','booking_requests.carrier_id','carriers.id')
        ->where('driver_id',null)
        ->get();
        $carriers_without_truck = Carrier::leftJoin('booking_requests','booking_requests.carrier_id','carriers.id')
        ->where('vehicle_id',null)
        ->get();

        return view('carriers.withoutTruckDriver',[
            'carriers_without_driver' => $carriers_without_driver,
            'carriers_without_truck' => $carriers_without_truck
        ]);
    }

    public static function history(){
        $carriers = Carrier::withCount('booking_requests.vehicle')->get();
        return view('carriers.history',['carriers' => $carriers]);
    }

    public static function viewHistory($model, $id){
        $carriers_history = BookingRequest::with(['carrier','driver','vehicle.vehicle_brand','vehicle.vehicle_model','pickup_address','dropoff_address'])
        ->where('carrier_id',$id)
        ->get();
        return view('carriers.view_history',['carriers' => $carriers_history]);
        
    }

    public static function booking_requests($model, Request $request, $api, $id)
    {
        $carrier = Carrier::findOrFail($id);
        $booking_requests = $carrier->booking_requests;
        $response = self::generate_response('App\\Models\\BookingRequests');
        $response->data = $booking_requests;
        $response->entry_keys = LarablendCrudController::model_to_entry_keys('App\\Models\\BookingRequests');
        $new_data = [];
        foreach($booking_requests as $entry){
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
            $now = Carbon::now();
            $pickup_datetime = Carbon::parse($newObject->pickup_datetime);
            if($pickup_datetime < $now && $newObject->request_status->id < 3){
                continue;
            }else{
                array_push($new_data, $newObject);
            }
            
        }
        $response->data = $new_data;
        return response()->json($response);
    }

    public static function accounts($model, Request $request, $api, $id){
        $carrier = Carrier::findOrFail($id);
        $min_datetime = Carbon::parse($request->min_datetime);
        $max_datetime = Carbon::parse($request->max_datetime);
        $period = CarbonPeriod::create($min_datetime, $max_datetime);
        $booking_trips = BookingRequest::where('carrier_id', $id)->where('request_status_id_status', '4')->get();
        $total_income = self::calculate_income($period, $booking_trips);
        $total_commission = ($total_income * $carrier->commission)/100;
        $total_expenses = self::calculate_expense($period, $id)->expenses;
        $net_income = $total_income - $total_commission - $total_expenses;
        $response = self::generate_response($model);
        $data = new \stdClass();
        $data->total_income = $total_income;
        $data->total_expense = $total_expenses;
        $data->total_commission = $total_commission;
        $data->net_income = $net_income;
        $response->data = [$data];
        return response()->json($response);
    }

    public static function income_statement($model, Request $request, $api, $id){
        $carrier = Carrier::findOrFail($id);
        $trips = BookingRequest::where('request_status_id_status', 4)->where('carrier_id', $id)->get();
        if($request->vehicle_id){
            $newTrips = [];
            foreach ($trips as $trip){
                if($trip->vehicle_id == $request->vehicle_id){
                    array_push($newTrips, $trip);
                }
            }
            $trips = $newTrips;
        }
        $min_datetime = Carbon::parse($request->min_datetime);
        $max_datetime = Carbon::parse($request->max_datetime);
        $period = CarbonPeriod::create($min_datetime, $max_datetime);
        $income = self::calculate_income($period, $trips);
        $report = self::calculate_expense($period, $id);
        $response = LarablendCrudController::generate_response($model);
        $data = new \stdClass();
        $data->income = $income;
        $data->engine_oil = $report->engine_oil;
        $data->oil_filter = $report->oil_filter;
        $data->fuel_filter = $report->fuel_filter;
        $data->air_filter = $report->air_filter;
        $data->air_filter_cleaning = $report->air_filter_cleaning;
        $data->fuel = $report->fuel;
        $data->tire_pressure = $report->tire_pressure;
        $data->total_expense = $report->expenses;
        $data->net_income = $income - $report->expenses;
        $response->data = [$data];
        return response()->json($response);
    }

    public static function calculate_expense($period, $id){
        $report = new \stdClass();
        // Expenses
        $expenses = 0;
        // EngineOil
        $engine_oil_expenses = 0;
        $engine_oil_changes = EngineOil::where('carrier_id', $id)->get();
        foreach ($engine_oil_changes as $engine_oil_change){
            $newEngineOilChanges = [];
            if($period->contains(Carbon::parse($engine_oil_change->entry_date))){
                $engine_oil_expenses += $engine_oil_change->total;
                array_push($newEngineOilChanges, $engine_oil_change);
            }
            $engine_oil_changes = $newEngineOilChanges;
        }
        $report->engine_oil = $engine_oil_expenses;
        $expenses += $engine_oil_expenses;
        // OilFilter
        $oil_filter_expenses = 0;
        $oil_filter_changes = OilFilter::where('carrier_id', $id)->get();
        foreach ($oil_filter_changes as $oil_filter_change){
            $newOilFilterChanges = [];
            if($period->contains(Carbon::parse($oil_filter_change->entry_date))){
                $oil_filter_expenses += $oil_filter_change->total;
                array_push($newOilFilterChanges, $oil_filter_change);
            }
            $oil_filter_changes = $newOilFilterChanges;
        }
        $report->oil_filter = $oil_filter_expenses;
        $expenses += $oil_filter_expenses;
        // FuelFilter
        $fuel_filter_expenses = 0;
        $fuel_filter_changes = FuelFilter::where('carrier_id', $id)->get();
        foreach ($fuel_filter_changes as $fuel_filter_change){
            $newFuelFilterChanges = [];
            if($period->contains(Carbon::parse($fuel_filter_change->entry_date))){
                $fuel_filter_expenses += $fuel_filter_change->total;
                array_push($newFuelFilterChanges, $fuel_filter_change);
            }
            $fuel_filter_changes = $newFuelFilterChanges;
        }
        $report->fuel_filter = $fuel_filter_expenses;
        $expenses += $fuel_filter_expenses;
        // AirFilter
        $air_filter_expenses = 0;
        $air_filter_changes = AirFilter::where('carrier_id', $id)->get();
        foreach ($air_filter_changes as $air_filter_change){
            $newAirFilterChanges = [];
            if($period->contains(Carbon::parse($air_filter_change->entry_date))){
                $air_filter_expenses += $air_filter_change->total;
                array_push($newAirFilterChanges, $air_filter_change);
            }
            $air_filter_changes = $newAirFilterChanges;
        }
        $report->air_filter = $air_filter_expenses;
        $expenses += $air_filter_expenses;
        // AirFilterCleaning
        $air_filter_cleaning_expenses = 0;
        $air_filter_cleaning_changes = AirFilterCleaning::where('carrier_id', $id)->get();
        foreach ($air_filter_cleaning_changes as $air_filter_cleaning_change){
            $newAirFilterCleaningChanges = [];
            if($period->contains(Carbon::parse($air_filter_cleaning_change->entry_date))){
                $air_filter_cleaning_expenses += $air_filter_cleaning_change->total;
                array_push($newAirFilterCleaningChanges, $air_filter_cleaning_change);
            }
            $air_filter_cleaning_changes = $newAirFilterCleaningChanges;
        }
        $report->air_filter_cleaning = $air_filter_cleaning_expenses;
        $expenses += $air_filter_cleaning_expenses;
        // Fuel
        $fuel_expenses = 0;
        $fuel_refills = Fuel::where('carrier_id', $id)->get();
        foreach ($fuel_refills as $fuel_refill){
            $newFuelRefills = [];
            if($period->contains(Carbon::parse($fuel_refill->entry_date))){
                $fuel_expenses += $fuel_refill->total;
                array_push($newFuelRefills, $fuel_refill);
            }
            $fuel_refills = $newFuelRefills;
        }
        $report->fuel = $fuel_expenses;
        $expenses += $fuel_expenses;
        // TirePressure
        $tire_pressure_expense = 0;
        $tire_pressure_changes = TirePressure::where('carrier_id', $id)->get();
        foreach ($tire_pressure_changes as $tire_pressure_change){
            $newTirePressureChanges = [];
            if($period->contains(Carbon::parse($tire_pressure_change->entry_date))){
                $tire_pressure_expense += $tire_pressure_change->total;
                array_push($newTirePressureChanges, $tire_pressure_change);
            }
            $tire_pressure_changes = $newTirePressureChanges;
        }
        $report->tire_pressure = $tire_pressure_expense;
        $expenses += $tire_pressure_expense;
        $report->expenses = $expenses;
        return $report;
    }

    public static function calculate_income($period, $trips){
        foreach ($trips as $trip){
            $newTrips = [];
            if($period->contains(Carbon::parse($trip->pickup_datetime))){
                array_push($newTrips, $trip);
            }
            $trips = $newTrips;
        }
        $income = 0;
        foreach ($trips as $trip){
            $income += $trip->fare->value_head;
        }
        return $income;
    }
}
