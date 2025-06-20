<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'slug',
        'jp_title',
        'np_title',
        'jp_slug',
        'np_slug',
        'blog_category_id',
        'description',
        'jp_description',
        'np_description',
        'image',
        'status',
        'type',
    ];
    public function blogCategory()
    {
        return $this->belongsTo(BlogCategory::class, 'blog_category_id');
    }
}
