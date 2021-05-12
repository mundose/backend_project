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
            /**Escribimos las columnas de las tablas */
            $table->id();
            $table->integer('category_id')->unsigned();
            $table->text('title');
            $table->text('sumary');
            $table->text('image');
            $table->text('desciption');
            $table->text('author');
            $table->timestamps();
        });
        Schema::table('posts', function (Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('categories');
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
