<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Map extends Model
{   protected $table='maps';
    protected $fillable=['pharmacy','town','lat','lng'];
}
