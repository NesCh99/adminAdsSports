<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deporte extends Model
{
    protected $table = 'deportes';
    protected $primaryKey = 'idDeporte';
    const CREATED_AT = 'CreacionDep'; // personaliza el campo created_at
    const UPDATED_AT = 'ModificacionDep'; // personaliza el campo updated_at
    use HasFactory;
    protected $fillable=['NombreDep', 'PortadaDep', 'DescripcionDep'];

    //Relacion uno a muchos con campeonato

    public function Campeonatos(){ //Realiza las relaciones
        return $this->hasMany(Campeonato::class, 'idDeporte'); //Relacion 1 a n Campeonatos
    }
}
