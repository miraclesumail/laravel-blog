<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Animals extends Model
{
     public static function getTotalType(){
         // return self::where('color', 'yellow')->get();
         // return self::distinct()->count('type');
         // 获取type有多少种
         return self::distinct()->get(['type']);  
     }

     public static function getAnimalByType($type, $count=3, $page=1){
         
         return self::where('type', $type)->offset(($page-1)*$count)->limit($count)->get();
     }

     public static function getAniCount($type){
         return self::where('type', $type)->count();
     }

}