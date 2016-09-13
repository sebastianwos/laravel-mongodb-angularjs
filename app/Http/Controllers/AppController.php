<?php

namespace App\Http\Controllers;

use App\BusStop;
use App\Line;
use App\Table;
use Illuminate\Http\Request;
use App\Http\Requests;

class AppController extends Controller
{

    /**
     * Returns all the bus lines
     * @return mixed
     */
    public function getLines()
    {
        return Line::all();
    }

    /**
     * Returns all stops for current line
     * @param Line $line
     * @return mixed
     */
    public function getStops(Line $line)
    {
        return $line->busStops;
    }


    /**
     * Return
     * @param Line $line
     * @param BusStop $stop
     * @return mixed
     */
    public function getTable(Line $line, BusStop $stop)
    {
        return Table::forLineAndStop($line, $stop)->first();
    }

}
