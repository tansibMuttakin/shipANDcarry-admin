<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    //Carrier
    public function carrier()
    {
        return $this->belongsTo(Carrier::class);
    }

    //Adress
    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    // Brand
    public function vehicle_brand()
    {
        return $this->belongsTo(VehicleBrand::class);
    }

    // Model
    public function vehicle_model()
    {
        return $this->belongsTo(VehicleModel::class);
    }

    // Type
    public function vehicle_type()
    {
        return $this->belongsTo(VehicleType::class);
    }

    // Weight Category
    public function weight_category()
    {
        return $this->belongsTo(WeightCategory::class);
    }

    // Matched Booking Requests
    public function matched_booking_requests()
    {
        return $this->belongsToMany(BookingRequest::class, 'booking_request_vehicles');
    }
}
