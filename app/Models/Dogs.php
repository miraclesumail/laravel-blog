<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dogs extends Model
{
     public static function getDogs(){
          return self::where('color', 'yellow')->get();
     }

}
