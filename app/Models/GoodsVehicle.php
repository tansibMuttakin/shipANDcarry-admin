<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoodsVehicle extends Model
{
    use HasFactory;

    // Goods Type
    public function goods_type()
    {
        return $this->belongsTo(GoodsType::class);
    }

    // Vehicle Type
    public function vehicle_type()
    {
        return $this->belongsTo(VehicleType::class);
    }
}
