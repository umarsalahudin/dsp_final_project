<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $connection = 'mysql2';

    protected $table='locations';
    protected $fillable=['pharmacy','town','lat','lng'];
}
