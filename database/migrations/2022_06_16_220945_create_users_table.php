<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Administradores', function (Blueprint $table) {
            $table->engine = 'InnoDB'; //Habilitar InnoDB en la Base de Datos
            $table->id('idAdministrador');
            //$table->unsignedBigInteger('idRol');//Clave Foranea
            $table->string('NombreAdm');
            $table->date('FechaCaducidadAdm');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamp('CreacionAdm')->nullable();
            $table->timestamp('ModificacionAdm')->nullable();
            //Definicion de la clave foranea
            //$table->foreign('idRol')->references('idRol')->on('Roles')->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Administradores');
    }
}
