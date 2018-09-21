<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class flights extends Model
{
    protected $tables = 'my_flights';

    public static function getFlights(){
        return self::all();
    }
}
