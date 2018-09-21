<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class positions extends Model
{
    protected $table = "positions";

    public static function getPosition($name){
        return self::where('title', 'like', '%'.$name.'%')->get();
    }
}