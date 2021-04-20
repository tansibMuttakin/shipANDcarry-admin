<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeightCategory extends Model
{
    use HasFactory;

    // Weight Category Fare
    public function fare()
    {
        return $this->belongsTo(Fare::class);
    }
}
