<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMetadatoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('MetaDato', function (Blueprint $table) {
            $table->id('idMetaDato');//PK
            $table->unsignedBigInteger('idVideo');//FK
            $table->string('StreamKeyMetaDato');
            $table->string('LiveStreamIdMetaDato');
            $table->string('PlayerMetaDato');
            //$table->char('EstadoMetaDato',15);
            $table->timestamp('CreacionMetaDato')->nullable();
            $table->timestamp('ModificacionMetaDato')->nullable();
            //Relacion a Videos
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
        Schema::dropIfExists('MetaDato');
    }
}
