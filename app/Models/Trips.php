<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trips extends Model
{
    use HasFactory;

    protected $table='trips';
    protected $fillable = [
        'section_id',
        'transport_id',
        'type_id',
        'section_end',
        'date',
        'time',
        'num_seat'

    ];

    /**
     * Get all of the comments for the Trips
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function complaint()
    {
        return $this->hasMany(Complaint::class, 'trip_id');
    }

    public function reservation()
    {
        return $this->hasMany(Reservation::class, 'trip_id');
    }

    public function rate()
    {
        return $this->hasMany(Rate::class, 'trip_id');
    }

    public function avg_rate()
    {
        return $this->hasOne(Avg_Rate::class, 'trip_id');
    }


    // public function ship_goods_request()
    // {
    //     return $this->hasMany(Ship_Goods_Request::class, 'trip_id');
    // }

    public function trip_request()
    {
        return $this->hasOne(Trip_Request::class, 'trip_id');
    }

    public function PRICE_T()
    {
        return $this->hasOne(Price_Trip::class, 'trip_id');
    }
    /**
     * Get the user that owns the Trips
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }

    public function transporter()
    {
        return $this->belongsTo(Transporting::class, 'transport_id');
    }

    public function type()
    {
        return $this->belongsTo(Type::class, 'type_id');
    }
}
