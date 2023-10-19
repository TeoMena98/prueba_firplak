<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePruebasEntregaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pruebas_entrega', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('guia_transporte_id')->unsigned();
            $table->dateTime('fecha_de_entrega');
            $table->string('foto_pod');
    
            $table->foreign('guia_transporte_id')->references('id')->on('guias_transporte');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pruebas_entrega');
    }
}
