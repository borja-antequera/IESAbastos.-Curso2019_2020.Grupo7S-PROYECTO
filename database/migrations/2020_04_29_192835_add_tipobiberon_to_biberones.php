<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTipobiberonToBiberones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('biberones', function (Blueprint $table) {
            
            $table->unsignedBigInteger('tipo_biberon_id');
            $table->foreign('tipo_biberon_id')->references('id')->on('biberones')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('biberones', function (Blueprint $table) {
            //
        });
    }
}
