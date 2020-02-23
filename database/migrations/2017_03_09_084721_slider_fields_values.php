<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SliderFieldsValues extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('slidersfieldsvalues', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('field_id')->unsigned()->references('id')->on('slidersfields')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('slider_id')->unsigned()->references('id')->on('sliders')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('data_id')->unsigned();
            $table->text('value')->nullable()->default(null);
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('slidersfieldsvalues');
    }

}
