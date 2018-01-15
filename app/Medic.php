<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medic extends Model
{
    
    protected $connection = 'mysql3';

    protected $table='medics';
    protected $fillable = [
        'name', 'quantity', 'company','address',
    ];
}
