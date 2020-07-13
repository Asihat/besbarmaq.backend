<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmslistTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smslist', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->tinyInteger('status')->comment('0 - none, 1 - active')->default(1);
            $table->string('phoneNo');
            $table->string('message');
            $table->string('code');
            $table->tinyInteger('type')->default(0)->comment('0 - default value, 1 - FORGOT PASSWORD');
            // TODO define type column
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
        Schema::dropIfExists('smslist');
    }
}
