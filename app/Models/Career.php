<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'slug',
        'description',
        'position',
        'location',
        'start_date',
        'end_date',
        'jp_title',
        'jp_slug',
        'status',
        'type_id',
        'jp_description',
        'jp_position',
        'jp_location',
        'jp_start_date',
        'jp_end_date',
    ];
    public function type()
    {
        return $this->belongsTo(Type::class, 'type_id');
    }
    public function careerforms()
    {
        return $this->hasMany(CareerForm::class, 'career_id');
    }
}
