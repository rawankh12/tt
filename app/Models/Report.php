<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $table='report';
    protected $fillable = [
        'num_transport',
        'public_trip',
        'private_trip',
        'admin_id',
        'price_all'
    ];
}
