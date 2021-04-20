<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TripDriver extends Model
{
    use HasFactory;

    // Booking Request
    public function booking_request()
    {
        return $this->belongsTo(BookingRequest::class);
    }

    // Driver
    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    // Timeline
    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}
