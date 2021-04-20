<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingRequestCarrier extends Model
{
    use HasFactory;

    public function booking_request()
    {
        return $this->belongsTo(BookingRequest::class);
    }

    public function carrier()
    {
        return $this->belongsTo(Carrier0::class);
    }
}
