<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    protected $table='type';
    protected $fillable = [
        'name',
    ];

    /**
     * Get all of the comments for the Type
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function trip()
    {
        return $this->hasMany(Trips::class, 'type_id');
    }
}
