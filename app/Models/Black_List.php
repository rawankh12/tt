<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Black_List extends Model
{
    use HasFactory;

    protected $table='black_list';
    protected $fillable = [
        'admin_id',
        'user_id',
        'num'
    ];


    /**
     * Get the user that owns the Black_List
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
