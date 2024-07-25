<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use HasFactory;
    
    protected $table='address';
    protected $fillable = [
        'name',
    ];

    /**
     * Get the user associated with the Address
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function section()
    {
        return $this->hasOne(Section::class, 'address_id');
    }
}
