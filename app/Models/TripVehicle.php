<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TripVehicle extends Model
{
    use HasFactory;

    // Booking Request
    public function booking_request()
    {
        return $this->belongsTo(BookingRequest::class);
    }

    // Vehicle
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    // Carrier
    public function carrier()
    {
        return $this->belongsTo(Carrier::class);
    }
}
