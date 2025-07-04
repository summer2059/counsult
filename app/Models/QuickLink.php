<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuickLink extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'slug',
        'url',
        'status',
        'priority',
        'jp_title',
        'jp_slug',
        'jp_url',
        'type_id',
    ];

    public function type(){
        return $this->belongsTo(Type::class);
    }
}
