<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMensajesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mensajes', function (Blueprint $table) {
            $table->bigIncrements('id');            
            $table->unsignedBigInteger('emisor_id');
            $table->foreign('emisor_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('receptor_id');
            $table->foreign('receptor_id')->references('id')->on('users')->onDelete('cascade');
            $table->longtext('mensaje');
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
        Schema::dropIfExists('mensajes');
    }
}
