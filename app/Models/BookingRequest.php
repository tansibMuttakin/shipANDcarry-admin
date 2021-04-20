<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingRequest extends Model
{
    use HasFactory;

    // Shipper
    public function shipper()
    {
        return $this->belongsTo(Shipper::class);
    }

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

    // Vehicle
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    // Trip Status
    public function trip_status()
    {
        return $this->belongsTo(Status::class, 'trip_status_id_status');
    }

    // Request Status
    public function request_status()
    {
        return $this->belongsTo(Status::class, 'request_status_id_status');
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

    // Weight Category
    public function weight_category()
    {
        return $this->belongsTo(WeightCategory::class);
    }

    // Trip Fare
    public function fare()
    {
        return $this->belongsTo(Fare::class);
    }

    // Recipients
    public function recipients()
    {
        return $this->hasMany(Recipient::class);
    }

    // Trip Drivers
    public function trip_drivers()
    {
        return $this->hasMany(TripDriver::class);
    }

    // Trip Vehicles
    public function trip_vehicles()
    {
        return $this->hasMany(TripVehicle::class);
    }

    // Booking Vehicle Types
    public function trip_vehicle_types()
    {
        return $this->hasMany(TripVehicleType::class);
    }

    // Products
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    // Timelines
    public function timelines()
    {
        return $this->hasMany(Timeline::class);
    }

    public function carriers()
    {
        return $this->belongsToMany(Carrier::class, 'booking_request_carriers');
    }

    //Eligible Vehicles
    public function eligible_vehicles()
    {
        return $this->belongsToMany(Vehicle::class, 'booking_request_vehicles');
    }
}
