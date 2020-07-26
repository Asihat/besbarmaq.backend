<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLentaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lenta', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->default('Undefined');
            $table->string('description');
            $table->integer('user_id');
            $table->double('price');
            $table->string('photo');
            $table->string('work_time');
            $table->string('average_time');
            $table->tinyInteger('rating')->default(0);
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
        Schema::dropIfExists('lenta');
    }
}
