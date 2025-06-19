<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestimonialBanner extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'slug',
        'image',
    ];
    public function getImage(){
        return asset('uploads/images/' . $this->image);
    }

}
