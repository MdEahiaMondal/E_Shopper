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
            $table->longText('User_App_Id')->nullable();
            $table->string('provider_name')->default('nothing');
            $table->string('name', 60)->nullable();
            $table->string('nickname')->nullable();
            $table->string('lastname', 60)->nullable();
            $table->string('birthday',40)->nullable();
            $table->string('gender',10)->nullable();
            $table->string('address',200)->nullable();
            $table->string('avatar',100)->nullable();
            $table->string('email',80)->nullable();
            $table->string('phone', 25)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
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
        Schema::dropIfExists('users');
    }
}
