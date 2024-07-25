<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    use HasFactory;

    protected $table='rate';
    protected $fillable = [
        'trip_id',
        'user_id',
        'love',
    ];

    public function trip()
    {
        return $this->belongsTo(Trips::class, 'trip_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
