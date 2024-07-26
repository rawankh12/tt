<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserJob extends Model
{
    use HasFactory;

    protected $table='user_jobs';

    protected $fillable = [
        'user_id',
        'job_id',
    ];

    // public function user()
    // {
    //     return $this->belongsToMany(User::class, 'user_id');
    // }

    // public function job()
    // {
    //     return $this->belongsToMany(Job::class, 'job_id');
    // }

}
