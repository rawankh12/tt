<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ship_Goods_Request extends Model
{
    use HasFactory;

    protected $table='ship_goods_request';
    protected $fillable = [
        'user_id',
        'section_end_id',
        'section_id',
        'weight',
        'quantity',
        'description'
    ];

    /**
     * Get the user that owns the Ship_Goods_Request
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the user that owns the Ship_Goods_Request
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sec_end()
    {
        return $this->belongsTo(Section::class, 'section_end_id');
    }

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }
}
