<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnquiryMessage extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'service_id',
    ];
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
