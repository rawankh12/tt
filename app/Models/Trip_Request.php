<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip_Request extends Model
{
    use HasFactory;

    protected $table='trip_requests';
    protected $primaryKey ="tr_id";

    protected $fillable = [
        'user_id',
        'trip_id',
        'start_point',
        'description_admin'
    ];

    /**
     * Get the user that owns the Trip_Request
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function trip()
    {
        return $this->belongsTo(Trips::class, 'trip_id');
    }
}
