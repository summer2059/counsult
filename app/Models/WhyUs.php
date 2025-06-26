<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhyUs extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'slug',
        'description',
        'image',
        'jp_title',
        'jp_slug',
        'image2',
        'jp_description',
    ];
    public function getImage(){
        return asset('uploads/images/' . $this->image);
    }
    public function getImage2(){
        return asset('uploads/images2/'. $this->image2);
    }
}
