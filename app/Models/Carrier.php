<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrier extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function booking_requests()
    {
        return $this->belongsToMany(BookingRequest::class, 'booking_request_carriers');
    }
}
