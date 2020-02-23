<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ShopOrdersDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shopordersdetails', function(Blueprint $table){
            $table->increments('id');
            $table->integer('order_id')->references('id')->on('shoporders')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('product_id')->references('id')->on('catalogproducts')->onDelete('cascade')->onUpdate('cascade');
            $table->text('options');
            $table->integer('qty');
            $table->double('price');
            $table->timestamps();
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
        Schema::dropIfExists('shopordersdetails');
    }
}
