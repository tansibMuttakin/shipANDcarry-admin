<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoodsType extends Model
{
    use HasFactory;

    protected $casts = [
        'vehicle_type_ids' => 'array'
    ];

    public function vehicle_types()
    {
        return $this->belongsToMany(VehicleType::class, 'goods_type_vehicle_types');
    }
}
