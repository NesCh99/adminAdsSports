<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campeonato extends Model
{
    public $table = 'campeonatos';
    protected $primaryKey = 'idCampeonato';
    const CREATED_AT = 'CreacionCam'; // personaliza el campo created_at
    const UPDATED_AT = 'ModificacionCam'; // personaliza el campo updated_at
    protected $fillable=['idDeporte','NombreCam', 'DescripcionCam','FechaInicioCam', 'PortadaCam', 'DescuentoCam'];
    use HasFactory;

    //Relacion uno a muchos con videos

    public function Videos(){ //Realiza la relacion
        return $this->hasMany(Video::class, 'idCampeonato'); //Relacion 1 a n Videos
        
    }

    public function Deporte(){ //Realiza la relacion
        return $this->belongsTo(Deporte::class, 'idDeporte'); //Relacion n a 1 Deporte
    }
}
