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
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('login');
            $table->string('phoneNo');
            $table->string('password');
            $table->string('avatar');
            $table->string('name');
            $table->string('surname');
            $table->string('description');
            $table->integer('bloked')->comment('0 - bloked user, 1 - active user, 2 - registered user but not verified');
            $table->string('token');
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
        Schema::dropIfExists('users');
    }
}
