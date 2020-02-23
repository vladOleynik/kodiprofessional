<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PaymentMethods extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shoppaymentmethods', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('data')->nullable();
            $table->integer('enabled')->nullable()->default(0);
            $table->string('path')->nullable()->default(null);
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
        Schema::dropIfExists('shoppaymentmethods');
    }
}
