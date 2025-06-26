<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'position',
        'image',
        'description',
        'status',
        'priority',
        'jp_name',
        'jp_position',
        'image2',
        'jp_description',
        'type_id'
    ];
    public function type(){
        return $this->belongsTo(Type::class);
    }
}
