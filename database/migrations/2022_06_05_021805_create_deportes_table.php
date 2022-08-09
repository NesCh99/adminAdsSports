<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeportesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * Crea la tabla con sus atributos
         */
        Schema::create('Deportes', function (Blueprint $table) {
            $table->engine="InnoDB"; //Mecanismo de almacenamiento InnoDB
            $table->id('idDeporte'); //Clave Primaria
            $table->string('NombreDep'); 
            $table->string('PortadaDep');
            $table->text('DescripcionDep'); 
            $table->timestamp('CreacionDep')->nullable();
            $table->timestamp('ModificacionDep')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Deportes');
    }
}
