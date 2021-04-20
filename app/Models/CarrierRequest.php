<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarrierRequest extends Model
{
    use HasFactory;

    // Carrier
    public function carrier()
    {
        return $this->belongsTo(Carrier::class);
    }

    // Driver
    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    // Timeline
    public function timeline()
    {
        return $this->belongsTo(Timeline::class);
    }
}
