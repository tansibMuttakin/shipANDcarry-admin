<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleModel extends Model
{
    use HasFactory;

    // Weight Category
    public function weight_category()
    {
        return $this->belongsTo(WeightCategory::class);
    }

    public function booking_requests()
    {
        return $this->belongsToMany(BookingRequest::class, 'booking_request_vehicle_models');
    }
}
