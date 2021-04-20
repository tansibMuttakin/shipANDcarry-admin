<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timeline extends Model
{
    use HasFactory;

    // Status
    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    // Booking Request
    public function booking_request()
    {
        return $this->belongsTo(BookingRequest::class);
    }

    // Goods Type
    public function goods_type()
    {
        return $this->belongsTo(GoodsType::class);
    }
}
