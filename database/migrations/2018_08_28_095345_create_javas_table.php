<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJavasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasColumn('users', 'email')) {
            Schema::create('javas', function (Blueprint $table) {
                $table->increments('id');
                $table->string('what');
                $table->timestamps();
            });
        }   

        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('email', 'wtf');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('javas');
    }
}
