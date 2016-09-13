<?php

namespace App;

use Moloquent;

class Table extends Moloquent
{

    protected $fillable = ['data'];

    public function attach(Line $line, BusStop $stop)
    {
        $this->line_id = $line->id;
        $this->bus_stop_id = $stop->id;
        return $this;
    }

    public function scopeForLineAndStop($query, Line $line, BusStop $stop)
    {
        return $query->where(['line_id' => $line->id, 'bus_stop_id' => $stop->id]);
    }

}
