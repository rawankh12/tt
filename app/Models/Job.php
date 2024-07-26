<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $table='jobs';

    protected $fillable = [
        'name_job',
        'date',
        'description'
    ];

    public function user()
    {
        return $this->belongsToMany(User::class, 'user_id','user_jobs_id');
    }
}
