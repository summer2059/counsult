<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareerForm extends Model
{
    use HasFactory;
    protected $fillable = [
        'first_name',
        'last_name',
        'phone_number',
        'email',
        'cv',
        'type_id',
        'career_id',
    ];
    public function career()
    {
        return $this->belongsTo(Career::class, 'career_id');
    }
    public function type()
    {
        return $this->belongsTo(Type::class, 'type_id');
    }
}
