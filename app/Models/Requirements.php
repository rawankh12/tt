<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class  Requirements extends Model
{
    use HasFactory;

    protected $table='reqruitment_form';
    protected $fillable = [
        'user_id',
        'image_identity',
        'driving_licence',
        'description',
        'cv',
        'mobile_phone'
    ];

    /**
     * Get the user that owns the Requirements
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the user that owns the Requirements
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }
}
