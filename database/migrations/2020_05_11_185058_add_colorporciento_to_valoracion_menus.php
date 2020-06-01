<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColorporcientoToValoracionMenus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('valoracion_menus', function (Blueprint $table) {
            //
            $table->string('clase');
            $table->integer('porciento');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('valoracion_menus', function (Blueprint $table) {
            //
        });
    }
}
