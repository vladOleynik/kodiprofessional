<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SliderImages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('slidersimages', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('slider_id')->unsigned()->references('id')->on('sliders')->onDelete('cascade')->onUpdate('cascade');
            $table->string('path');
            $table->string('alt')->nullable()->default(null);
            $table->string('title')->nullable()->default(null);
            $table->string('content')->nullable()->default(null);
            $table->integer('parent_id')->nullable()->default(null);
            $table->integer('order')->nullable()->default(null);
            $table->integer('published')->nullable()->default(null);
            $table->softDeletes();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::dropIfExists('slidersimages');
    }
}
