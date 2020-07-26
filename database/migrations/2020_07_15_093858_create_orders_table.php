<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('lenta_id');
            $table->integer('user_id');
            $table->tinyInteger('status')
                ->comment('0 - new created, 1 - chief confirmed, 2 - payment made, 3 - cooking started, 4 - cooking finished, 5 - delivery, 6 - accepted by user, 7 - finished, -1 - error');
            $table->string('time');
            $table->integer('portion_no');
            $table->string('description');
            $table->binary('comment');
            $table->binary('offer');
            $table->tinyInteger('rating');
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
        Schema::dropIfExists('orders');
    }
}
