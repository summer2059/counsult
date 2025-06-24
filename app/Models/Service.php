<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $fillable = [
        'service_category_id',
        'title',
        'slug',
        'description',
        'image',
        'status',
        'priority',
        'price',
    ];
    public function serviceCategory()
    {
        return $this->belongsTo(ServiceCategory::class);
    }
    public function enquiryMessages()
    {
        return $this->hasMany(EnquiryMessage::class);
    }
}
