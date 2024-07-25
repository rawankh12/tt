<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Walet_section extends Model
{
    use HasFactory;

    protected $table='walet_section';
    protected $fillable = [
        'amount',
        'section_id'
    ];

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }
}
