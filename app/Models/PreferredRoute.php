<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreferredRoute extends Model
{
    use HasFactory;

    // Shipper
    public function shipper()
    {
        return $this->belongsTo(Shipper::class);
    }

    // Goods Type
    public function goods_type()
    {
        return $this->belongsTo(GoodsType::class);
    }

    // Packaging Type
    public function packaging_type()
    {
        return $this->belongsTo(PackagingType::class);
    }

    // Trip Type
    public function trip_type()
    {
        return $this->belongsTo(TripType::class);
    }

    // Route
    public function route()
    {
        return $this->belongsTo(Route::class);
    }

    // Pickup Address
    public function pickup_address()
    {
        return $this->belongsTo(Address::class, 'pickup_address_id_address');
    }

    // Dropoff address
    public function dropoff_address()
    {
        return $this->belongsTo(Address::class, 'dropoff_address_id_address');
    }

    // Recipients
    public function recipients()
    {
        return $this->hasMany(Recipient::class);
    }

    // Products
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
