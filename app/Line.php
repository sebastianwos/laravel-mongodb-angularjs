<?php

namespace App;

use Moloquent;

class Line extends Moloquent
{
    protected $fillable = ['name'];

    public function busStops()
    {
        return $this->belongsToMany('App\BusStop');
    }
}
