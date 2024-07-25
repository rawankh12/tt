<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price_Trip extends Model
{
    use HasFactory;

    protected $table='price_trip';
    protected $fillable = [
        'price',
        'trip_id',
    ];

    public function trip()
    {
        return $this->belongsTo(Trips::class, 'trip_id');
    }


}
