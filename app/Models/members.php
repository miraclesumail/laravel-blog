<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class members extends Model
{
    protected $table = 'members';

    public static function judge($username, $password){
        return self::where('name', $username)->pluck('password')[0] == $password;
    }

    public static function exist($name){
        return self::where('name', $name)->count() > 0 ? true : false;
    }

    public static function getRoleByName($username){
        return self::where('name', $username)->pluck('role')[0];
    }

    public static function getAll(){
        return self::all();
    }
}

