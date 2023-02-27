<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('phone')->unique;
            $table->string('email')->nullable();
            $table->string('password');
            $table->integer('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories');
            $table->string('image')->nullable();
            $table->string('role')->nullable();
            $table->integer('active')->default(1);
            $table->string('fcm_token')->nullable();
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
