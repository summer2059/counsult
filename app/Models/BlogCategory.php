<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'slug',
        'jp_title',
        'jp_slug',
        'np_title',
        'np_slug',
        'status',
    ];
}
