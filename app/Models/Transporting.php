<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transporting extends Model
{
    use HasFactory;

    protected $table='transporting';
    protected $fillable = [
        'section_id',
        'type_tra_id',
        'capacity',
        'number',
    ];

    /**
     * Get the user that owns the Transporting
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    // public function user()
    // {
    //     return $this->belongsTo(User::class, 'foreign_key', 'other_key');
    // }

    /**
     * Get all of the comments for the Transporting
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function trips()
    {
        return $this->hasMany(Trips::class, 'transport_id');
    }

    /**
     * Get the user that owns the Transporting
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type_tran()
    {
        return $this->belongsTo(TypeTran::class, 'type_tra_id');
    }
}
