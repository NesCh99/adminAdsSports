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
          
            $table->text('Direccion')->nullable(); //Puede ser nulo
            $table->char('Telefono', 10)->nullable(); //Puede ser nulo
            $table->enum('TipoPago', [1, 2])->default(1);// Tipo de pago 1: normal; 2: campeonato
            $table->string('Email');
            $table->timestamp('FechaHoraPago');
            $table->float('TotalPago');

            //Definicion de la clave foranea que refiere a Cliente
            $table->foreign('idCliente')->references('id')->on('users')->onDelete("cascade");
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
