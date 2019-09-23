<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->integer('category_id')->unsigned();/*thisng it will not be minus so use unsigned*/
            $table->integer('brand_id')->unsigned();
            $table->longText('description');
            $table->string('image')->nullable();
            $table->float('price');
            $table->integer('quantity');
            $table->string('size')->nullable();
            $table->string('color')->nullable();
            $table->tinyInteger('status')->default('0')->comment('1=active and 0=unactive');
            $table->tinyInteger('features')->default('0')->comment('1=sow the fetures and 0=or not');
            $table->softDeletes();
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
        Schema::dropIfExists('products');
    }
}
