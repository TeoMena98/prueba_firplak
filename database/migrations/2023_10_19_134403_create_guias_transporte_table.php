<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuiasTransporteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guias_transporte', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('documento_entrega_id')->unsigned();
            $table->dateTime('fecha_despacho');
            $table->dateTime('fecha_entrega_estimada');
    
            $table->foreign('documento_entrega_id')->references('id')->on('documentos_entrega');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('guias_transporte');
    }
}
