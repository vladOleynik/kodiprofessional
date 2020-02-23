<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;use Illuminate\Database\Migrations\Migration;

class SliderFields extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('slidersfields', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('slider_id')->unsigned()->references('id')->on('sliders')->onDelete('cascade')->onUpdate('cascade');
            $table->string('alias');
            $table->string('title');
            $table->string('field_type');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('slidersfields');
    }

}
