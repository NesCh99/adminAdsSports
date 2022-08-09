<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    public $table = 'videos';
    protected $primaryKey = 'idVideo';
    const CREATED_AT = 'CreacionVid'; // personaliza el campo created_at
    const UPDATED_AT = 'ModificacionVid'; // personaliza el campo updated_at
    protected $fillable=['idCampeonato',
                        'NombreVid', 
                        'DescripcionVid', 
                        'PortadaVid',
                        'FechaInicioVid', 
                        'HoraInicioVid',
                        'PrecioVid',
                        'EstadoVid'];
    use HasFactory;

    //Relacion uno a muchos inversa Campeonatos

    public function Campeonato(){ //Realiza la relacion
        return $this->belongsTo(Campeonato::class, 'idCampeonato'); //Relacion n a 1 Campeonato
    }

    //Relacion muchos a muchos 
    public function DetallesPago(){ //Realiza la relacion
        return $this->belongsToMany(Pago::class, 'detallespagos', 'idPago', 'idVideo'); //Relacion n a n Pagos
    }

    //Relacion muchos a muchos 
    public function Suscripciones(){ //Realiza la relacion
        return $this->belongsToMany(Cliente::class, 'suscripciones', 'idVideo', 'idCliente')->withPivot('TipoSus'); //Relacion n a n Cliente
    }

    //Relacion uno a uno
    public function MetaDato(){
        return $this->hasOne(MetaDato::class, 'idVideo');
    }
}
