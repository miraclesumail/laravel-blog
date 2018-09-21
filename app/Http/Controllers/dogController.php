<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dogs;
use App\Models\flights;
use App\Models\music;

class dogController extends Controller
{
      public function index(){
          dd(json_encode(Dogs::getDogs()));
      }

      public function flights(){
          dd(json_encode(flights::getFlights()));
      }

      public function musics(){
        dd(json_encode(music::getMusics()));
      }
}
