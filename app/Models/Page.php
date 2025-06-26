<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'slug',
        'description',
        'jp_title',
        'jp_slug',
        'jp_description',
        'status',
        'type_id',
    ];
    public function type()
    {
        return $this->belongsTo(Type::class, 'type_id');
    }
}
