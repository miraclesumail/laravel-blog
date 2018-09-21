<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class engineer extends Model
{
    protected $table = "engineer";

    public function phone(){
        return $this->belongsTo('App\Models\phone', 'workid', 'engineer_id');         
    } 
}