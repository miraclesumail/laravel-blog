<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFuckersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // schema 判断表中是否存在该字段
       
        if(Schema::hasColumn('users', 'email')) {
            Schema::create('fuckers', function (Blueprint $table) {
                $table->increments('id');
                $table->string('what');
                $table->timestamps();
            });
        }   
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fuckers');
    }
}
