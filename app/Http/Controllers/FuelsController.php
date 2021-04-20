<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fuel;

use Duoneos\Larablend\Http\Controllers\LarablendCrudController;

class FuelsController extends LarablendCrudController
{
    public static function milage(Request $request, $model, $api, $id)
    {
        $fuel_refils = Fuel::where('vehicle_id',$id)->get();
        $run = $fuel_refils[count($fuel_refils)-1]->meter_reading - $fuel_refils[count($fuel_refils)-2]->meter_reading;
        $fuel = $fuel_refils[count($fuel_refils)-2]->diesel_qty;
        $milage = round($run/$fuel, 2);
        $response = self::generate_response($model);
        $data = new \stdClass();
        $data->milage = $milage;
        $response->data = [$data];
        return response()->json($response);
    }
}
