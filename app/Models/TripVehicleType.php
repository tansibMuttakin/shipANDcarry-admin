<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TripVehicleType extends Model
{
    use HasFactory;

    // Booking Request
    public function booking_request()
    {
        return $this->belongsTo(BookingRequest::class);
    }

    // Vehicle Type
    public function vehicle_type()
    {
        return $this->belongsTo(VehicleType::class);
    }
}
