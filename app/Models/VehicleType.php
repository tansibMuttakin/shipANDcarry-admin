<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleType extends Model
{
    use HasFactory;

    public function goods_types()
    {
        return $this->belongsToMany(GoodsType::class, 'goods_type_vehicle_types');
    }
}
