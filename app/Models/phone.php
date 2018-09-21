<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class phone extends Model
{
    protected $table = "phone";
    //  public static function getDogs(){
    //       return self::where('color', 'yellow')->get();
    //  }

    public function engineer(){
        // return $this->hasOne('App\Models\engineer', 'workid', 'engineer_id');
         return $this->hasMany('App\Models\engineer', 'workid', 'engineer_id');
    }
}