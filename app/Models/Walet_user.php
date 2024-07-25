<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Walet_user extends Model
{
    use HasFactory;
    protected $table='walet_user';
    protected $fillable = [
        'amount',
        'user_id'
    ];

    /**
     * Get the user that owns the Walet_user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
