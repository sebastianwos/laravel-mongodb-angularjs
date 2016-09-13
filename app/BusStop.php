<?php

namespace App;

use Moloquent;

class BusStop extends Moloquent
{

    protected $fillable = ['name'];

    public function lines()
    {
        return $this->belongsToMany('App\Line');
    }
}
