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

    public function teams(){
        return $this->hasMany(Team::class);
    }
    public function visions(){
        return $this->hasMany(Vision::class);
    }
    public function missions(){
        return $this->hasMany(Mission::class);
    }
    public function messages(){
        return $this->hasMany(Message::class);
    }
    public function testimonials(){
        return $this->hasMany(Testimonial::class);
    }
    public function whyusDetails(){
        return $this->hasMany(WhyUsDetail::class);
    }
    public function banners(){
        return $this->hasMany(Banner::class);
    }
    public function consultDetails(){
        return $this->hasMany(CosultDetail::class);
    }
    public function serviceCategories(){
        return $this->hasMany(ServiceCategory::class);
    }
    public function services(){
        return $this->hasMany(Service::class);
    }
}
