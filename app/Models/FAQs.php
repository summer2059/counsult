<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FAQs extends Model
{
    use HasFactory;
    protected $fillable = [
        'question',
        'answer',
        'jp_question',
        'jp_answer',
        'type_id',
        'status'
    ];
    public function type()
    {
        return $this->belongsTo(Type::class, 'type_id');
    }
}
