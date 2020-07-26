<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChiefsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chiefs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('description');
            $table->tinyInteger('status')->comment('-1 - just created not activated, 0 - none, 1 - active, 2 - busy');
            $table->string('work_time');
            $table->string('location_id');
            $table->string('gender');
            $table->string('contact');
            $table->tinyInteger('home_cook')->comment('0 - NO, 1 - YES');
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
        Schema::dropIfExists('chiefs');
    }
}
