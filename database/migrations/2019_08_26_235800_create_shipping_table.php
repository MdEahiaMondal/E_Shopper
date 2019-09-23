<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShippingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shippings', function (Blueprint $table) {
            $table->bigInteger('id')->autoIncrement();
            $table->bigInteger('order_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->longText('address');
            $table->string('phone');
            $table->string('city');
            $table->timestamps();

            /*$table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');*/
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shipping');
    }
}
