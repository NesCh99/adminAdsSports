<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DetallePago extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('DetallesPagos', function (Blueprint $table) {
            /*Tabla maestro detalle de pagos que realizan los clientes por videos */
            $table->unsignedbigInteger('idPago');//Clave foranea refiere a Pago
            $table->unsignedbigInteger('idVideo'); //Clave foranea refiere a video
            //Datos pivot
            $table->float('PrecioPago');
            $table->timestamp('CreacionDetPag')->nullable();
            $table->timestamp('ModificacionDetPag')->nullable();

            //Definicion de la clave foranea que refiere a Video
            $table->foreign('idVideo')->references('idVideo')->on('Videos')->onDelete("cascade");

            //Definicion de la clave foranea que refiere a Pago
            $table->foreign('idPago')->references('idPago')->on('Pagos')->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('DetallesPagos');
    }
}
