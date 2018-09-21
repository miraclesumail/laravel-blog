<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class account extends Model
{
     protected $table = 'account';
     public $timestamps = false;

     public static function withdraw($username, $amount){
         //sleep(5);
         //account::getbalance($username)->toArray()[0]['balance']
         $balance = self::getbalance($username)->toArray()[0]['balance'] - $amount;
         self::where('username', $username)->update(['balance' => $balance]);
     }

     public static function getbalance($username){
         return self::where('username', $username)->get(['balance']);
     }    
}