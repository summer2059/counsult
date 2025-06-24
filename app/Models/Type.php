<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;
    protected $fillable = ['type'];
    public function careers(){
        return $this->hasMany(Career::class);
    }
    public function careerforms(){
        return $this->hasMany(CareerForm::class);
    }
    public function pages(){
        return $this->hasMany(Page::class);
    }
    public function faqs(){
        return $this->hasMany(FAQs::class);
    }
}
