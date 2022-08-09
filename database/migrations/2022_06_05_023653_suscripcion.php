<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Suscripcion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Suscripciones', function (Blueprint $table) {
            /* Tabla maestro detalle de suscripciones de clientes a videos */
            $table->unsignedbigInteger('idVideo'); //Clave foranea de Video
            $table->unsignedbigInteger('idCliente'); //Clave foranea de Cliente
            $table->enum('TipoSus', [1, 2])->default(1);// Tipo de suscripcion 1: normal; 2: invitado
            $table->timestamp('CreacionSus')->nullable();
            //Definicion de la clabe foranea que refiere a Cliente
            $table->foreign('idCliente')->references('idCliente')->on('Clientes')->onDelete("cascade");

            //Definicion de la clabe foranea que refiere a Video
            $table->foreign('idVideo')->references('idVideo')->on('Videos')->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('Suscripciones');
    }
}
