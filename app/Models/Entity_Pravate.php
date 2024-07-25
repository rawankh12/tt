<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entity_Pravate extends Model
{
    use HasFactory;

    protected $table='entity_private';
    protected $fillable = [
        'user_id',
        'entity_name',
        'photo_of_request'
    ];

    /**
     * Get the user that owns the Entity_Pravate
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
