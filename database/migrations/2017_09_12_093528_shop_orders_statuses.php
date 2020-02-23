<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ShopOrdersStatuses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shoporderstatuses', function(Blueprint $table){
            $table->increments('id');
            $table->string('title');
            $table->boolean('is_default')->default(0);
            $table->boolean('enabled')->default(1);
            $table->text('data');
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
        Schema::dropIfExists('shoporderstatuses');
    }
}
