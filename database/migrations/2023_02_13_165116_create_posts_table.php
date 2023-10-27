<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('category_id');
            $table->text('desc');
            $table->text('name')->nullable();
            $table->text('owner')->nullable();
            $table->string('contact');
            $table->text('bedroom')->nullable();
            $table->text('bathroom')->nullable();
            $table->json('images');
            $table->text('video')->nullable();
            $table->string('price');
            $table->text('profile_pic')->nullable();
            $table->string('quick_true')->nullable();
            $table->text('location');
            $table->string('saved')->nullable();
            $table->string('size');
            $table->text('status');
            $table->text('type');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('category_id')->references('id')->on('categories');
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
        Schema::dropIfExists('posts');
    }
}
