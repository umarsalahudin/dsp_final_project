<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Med extends Model
{
    
    protected $connection = 'mysql2';

    protected $table='meds';
    protected $fillable = [
        'name', 'quantity', 'company','address',
    ];

}
