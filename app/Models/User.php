<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use PhpParser\Node\Stmt\Block;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_name',
        'email',
        'password',
        'role_id',
        'phone'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the user that owns the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    /**
     * Get all of the comments for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function complaint()
    {
        return $this->hasOne(Complaint::class, 'user_id');
    }

    /**
     * Get all of the comments for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function entity_private()
    {
        return $this->hasMany(Entity_Pravate::class, 'user_id');
    }

    /**
     * Get the user associated with the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function requirement()
    {
        return $this->hasOne(Requirements::class, 'user_id');
    }

    public function reservation()
    {
        return $this->hasOne(Reservation::class, 'user_id');
    }

    public function section()
    {
        return $this->hasOne(Section::class, 'admin_id');
    }

    public function Walet()
    {
        return $this->hasOne(Walet_user::class, 'user_id');
    }


    public function ship_goods_request()
    {
        return $this->hasMany(Ship_Goods_Request::class, 'user_id');
    }

    public function transporting()
    {
        return $this->hasMany(Transporting::class, 'admin_id');
    }

    public function trip_request()
    {
        return $this->hasMany(Trip_Request::class, 'user_id');
    }

    public function black()
    {
        return $this->hasMany(Black_List::class, 'admin_id');
    }

    public function black_l()
    {
        return $this->hasMany(Black_List::class, 'user_id');
    }


    public function block()
    {
        return $this->hasMany(Block_List::class, 'admin_id');
    }

    public function block_l()
    {
        return $this->hasMany(Block_List::class, 'user_id');
    }

    public function rate()
    {
        return $this->hasMany(User::class, 'user_id');
    }
  
    public function job()
    {
        return $this->belongsToMany(Job::class, 'job_id');
    }
}
