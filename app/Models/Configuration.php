<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    use HasFactory;
    protected $fillable = [
        'configuration_key', 'configuration_value',
    ];

    public function getConfigurationValue($key){
        $model = new static();

        $row = $model->where('configuration_key', '=', $key)->first();
        if( $row != null ){
            return $row->configuration_value;
        }
    }
}
