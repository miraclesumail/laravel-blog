<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class music extends Model
{
    // 如果此music没有经过数据库迁移  指向的数据库中my_music表
    protected $table = 'my_musics';

    public static function getMusics(){
        return self::all();
    }
}
