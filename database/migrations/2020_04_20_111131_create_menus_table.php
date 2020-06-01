<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("menu_nombre", 255);
            $table->string("menu_desayuno_nombre", 255);
            $table->string("menu_primero_nombre", 255);
            $table->string("menu_segundo_nombre", 255);
            $table->string("menu_postre_nombre", 255);
            $table->string("menu_merienda_nombre", 255);
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
    }
}
