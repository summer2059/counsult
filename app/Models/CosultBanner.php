<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CosultBanner extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'slug',
        'description',
    ];
    public function getImage(){
        return asset('uploads/images/' . $this->image);
    }
}
