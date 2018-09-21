<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class jobs extends Model
{
    protected $table = "jobs";

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('age', function (Builder $builder) {
            $builder->where('salary', '>', 12000);
        });
    }

    public static function getJobs($des){
       // return self::where('des', '=', $des)->get();
       return self::all();
    }


}