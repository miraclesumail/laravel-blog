<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhpersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       
            Schema::create('phpers', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->integer('age');
                $table->string('gender');
                //$table->timestamps();
            });
          
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('phpers');
    }
}
