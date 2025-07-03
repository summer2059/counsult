<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeOffer extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'slug',
        'image',
        'description',
        'status',
        'jp_title',
        'jp_slug',
        'jp_description',
        'image2',
        'type_id',
    ];

    public function type(){
        return $this->belongsTo(Type::class);
    }
}
