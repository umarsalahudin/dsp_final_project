<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loc extends Model
{
    protected $connection = 'mysql3';

    protected $table='locs';
    protected $fillable=['pharmacy','town','lat','lng'];
}
