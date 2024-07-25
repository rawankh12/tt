<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avg_Rate extends Model
{
    use HasFactory;
    protected $table='avg_rate';
    protected $fillable = [
        'trip_id',
        'avg_rate',
    ];


    public function trip()
    {
        return $this->belongsTo(Trips::class, 'trip_id');
    }
}

