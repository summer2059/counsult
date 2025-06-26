<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'slug',
        'jp_title',
        'jp_slug',
        'status',
        'type_id',
    ];
    public function type()
    {
        return $this->belongsTo(Type::class);
    }
}
