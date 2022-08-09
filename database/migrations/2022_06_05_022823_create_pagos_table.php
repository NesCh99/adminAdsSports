<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Pagos', function (Blueprint $table) {
            $table->engine = 'InnoDB';//Mecanismo de almacenamiento InnoDB
            $table->id('idPago');//Clave Primaria
            $table->unsignedbigInteger('idCliente');//Clave Secundaria
            $table->string('NombreCompleto');
            $table->char('Identificacion', 10);
            $table->text('Direccion')->nullable(); //Puede ser nulo
            $table->char('Telefono', 10)->nullable(); //Puede ser nulo
            $table->string('Email');
            $table->timestamp('FechaHoraPago');
            $table->float('TotalPago');

            //Definicion de la clave foranea que refiere a Cliente
            $table->foreign('idCliente')->references('idCliente')->on('Clientes')->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Pagos');
    }
}
