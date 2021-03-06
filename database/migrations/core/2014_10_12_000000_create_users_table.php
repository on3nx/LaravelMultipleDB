<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('core')->create('users', function(Blueprint $table){
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('email')->unique();
            $table->string('username')->unique();
            $table->string('password');
            $table->string('firstname');
            $table->string('lastname');
            $table->date('dateofbirth');
            $table->tinyInteger('gender');
            $table->boolean('activated')->default(false);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
