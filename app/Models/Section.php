<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $table='section';
    protected $fillable = [
        'admin_id',
        'address_id',
        'time_opened',
        'time_closed'
    ];

    /**
     * Get the user that owns the Section
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function address()
    {
        return $this->belongsTo(Address::class, 'address_id');
    }

    /**
     * Get all of the comments for the Section
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function requirement()
    {
        return $this->hasMany(Requirements::class, 'section_id');
    }

    public function ship_goods_request()
    {
        return $this->hasMany(Ship_Goods_Request::class, 'section_id');
    }

    public function ship_goods_requestt()
    {
        return $this->hasMany(Ship_Goods_Request::class, 'section_end_id');
    }

    public function trips()
    {
        return $this->hasMany(Trips::class, 'section_id');
    }

    public function resignation()
    {
        return $this->hasMany(Resignation::class, 'section_id');
    }

    /**
     * Get the user associated with the Section
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function Walet_s()
    {
        return $this->hasOne(Walet_section::class, 'section_id');
    }
}
