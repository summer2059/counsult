<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhyUsDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'slug',
        'description',
        'image',
        'status',
        'priority',
        'jp_title',
        'jp_slug',
        'jp_description',
        'image2',
        'type_id'
    ];
    public function type()
    {
        return $this->belongsTo(Type::class);
    }
}
