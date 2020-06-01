<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAulaMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aula_menus', function (Blueprint $table) {
            $table->bigIncrements('id');   
            $table->unsignedBigInteger('aula_id');         
            $table->foreign('aula_id')->references('id')->on('aulas');
            $table->unsignedBigInteger('menu_id'); 
            $table->foreign('menu_id')->references('id')->on('menus');
            $table->date('fecha_asociada');
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
        Schema::dropIfExists('aula_menus');
    }
}
