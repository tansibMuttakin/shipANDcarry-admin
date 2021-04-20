<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TripTypeNew extends Model
{
    use HasFactory;

    public function route_news()
    {
        return $this->belongsTo(RouteNew::class);
    }
}
