<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeTran extends Model
{
    use HasFactory;

    protected $table='type_transporting';
    protected $fillable = [
        'name_t',
    ];

    /**
     * Get all of the comments for the TypeTran
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transport()
    {
        return $this->hasMany(Transporting::class, 'type_tra_id');
    }

}
