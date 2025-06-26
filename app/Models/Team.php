<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'position',
        'image',
        'priority',
        'status',
        'jp_name',
        'jp_position',
        'type_id',
    ];
    public function type()
    {
        return $this->belongsTo(Type::class);
    }
}
