<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipient extends Model
{
    use HasFactory;

    public function booking_requests()
    {
        return $this->belongsTo(BookingRequest::class);
    }

    public function preferred_routes()
    {
        return $this->hasMany(PreferredRoute::class);
    }
}
