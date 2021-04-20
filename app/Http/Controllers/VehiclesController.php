<?php

namespace App\Http\Controllers;

use App\Models\VehicleModel;
use Illuminate\Http\Request;
use Duoneos\Larablend\Http\Controllers\LarablendCrudController;

class VehiclesController extends LarablendCrudController
{
    public static function store($model, Request $request, $api)
    {
        $vehicle_model = VehicleModel::findOrFail($request->vehicle_model_id);
        $weight_taken = $vehicle_model->taken_weight;
        $body_length = $vehicle_model->body_length;
        $request->merge([
           'body_length_ignore' => $body_length,
           'weight_taken_ignore' => $weight_taken,
        ]);
        return parent::store($model, $request, $api); // TODO: Change the autogenerated stub
    }
}
