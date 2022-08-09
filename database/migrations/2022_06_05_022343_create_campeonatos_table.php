<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampeonatosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Campeonatos', function (Blueprint $table) {
            $table->engine="InnoDB"; //Mecanismo de almacenamiento Inno DB
            $table->id('idCampeonato');//Clave Primaria
            $table->unsignedbigInteger('idDeporte');//Clave Foranea
            $table->string('NombreCam');
            $table->text('DescripcionCam');
            $table->date('FechaInicioCam');
            $table->string('PortadaCam');
            $table->integer('DescuentoCam');
            $table->timestamp('CreacionCam')->nullable();
            $table->timestamp('ModificacionCam')->nullable();

            //Definicion de la clave foranea que refiere a Deporte
            $table->foreign('idDeporte')->references('idDeporte')->on('Deportes')->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Campeonatos');
    }
}
