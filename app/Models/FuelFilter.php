<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FuelFilter extends Model
{
    use HasFactory;

    // Carrier
    public function carrier()
    {
        return $this->belongsTo(Carrier::class);
    }

    // Vehicle
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
