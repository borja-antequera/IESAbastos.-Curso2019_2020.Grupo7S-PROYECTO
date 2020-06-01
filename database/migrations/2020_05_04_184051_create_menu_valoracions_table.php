<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuValoracionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_valoraciones', function (Blueprint $table) {
            $table->bigIncrements('id'); 

            $table->unsignedBigInteger('menu_id');
            $table->foreign('menu_id')->references('id')->on('menus')->onDelete('cascade');

            $table->unsignedBigInteger('menu_valoracion_desayuno_id');
            $table->foreign('menu_valoracion_desayuno_id')->references('id')->on('valoracion_menus')->onDelete('cascade');
            
            $table->unsignedBigInteger('menu_valoracion_primero_id');
            $table->foreign('menu_valoracion_primero_id')->references('id')->on('valoracion_menus')->onDelete('cascade');

            
            $table->unsignedBigInteger('menu_valoracion_segundo_id');
            $table->foreign('menu_valoracion_segundo_id')->references('id')->on('valoracion_menus')->onDelete('cascade');

            
            $table->unsignedBigInteger('menu_valoracion_postre_id');
            $table->foreign('menu_valoracion_postre_id')->references('id')->on('valoracion_menus')->onDelete('cascade');

            
            $table->unsignedBigInteger('menu_valoracion_merienda_id');
            $table->foreign('menu_valoracion_merienda_id')->references('id')->on('valoracion_menus')->onDelete('cascade');

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
        Schema::dropIfExists('menu_valoraciones');
    }
}
