<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class privilege extends Model
{
    protected $table = 'previllige';

    public static function getPrilegeByRole($role_id){
        
        //  return self::where('role',  'like', '%' . $role_id . '%')->get()->filter(function ($name) {
        //       return explode(",", $name->original['role'];
        //  });

         return self::all()->filter(function ($name) use($role_id){
            return in_array($role_id, explode(",", $name->original['role']));
         })->map(function ($name) {
             return $name->original;
         });
    }

    // static function object_to_array($obj){
      
    //     $obj = (array)$obj;
    //     foreach ($obj as $k => $v) {
    //         if (gettype($v) == 'resource') {
    //             return;
    //         }
    //         if (gettype($v) == 'object' || gettype($v) == 'array') {
    //             $obj[$k] = (array)self::object_to_array($v);
    //         }
    //     }
     
    //     return $obj;

    //     }
        
}
