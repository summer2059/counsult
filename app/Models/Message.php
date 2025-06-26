<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'position',
        'message',
        'image',
        'jp_name',
        'jp_position',
        'jp_message',
        'image2',
        'status',
        'priority',
        'type_id',
    ];
    public function type()
    {
        return $this->belongsTo(Type::class);
    }
}
