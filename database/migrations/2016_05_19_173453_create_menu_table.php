<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;


class CreateMenuTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('title')->unique();
            $table->string('alias')->unique();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('menuitems', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('menu_id')->references('id')->on('menus')->onDelete('cascade')->onUpdate('cascade');
            $table->string('title');
            $table->string('url');
            $table->string('target')->default('_self');
            $table->integer('_lft')->default(0);
            $table->integer('_rgt')->default(0);
            $table->string('module')->default('menus');
            $table->integer('parent_id')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('menus');
        Schema::dropIfExists('menuitems');
    }

}
