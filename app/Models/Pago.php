<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'pagos';
    protected $primaryKey = 'idPago';
    const CREATED_AT = 'FechaHoraPago';
  
    protected $fillable =   [
        'idPago',
        'idCliente',
        'NombreCompleto',
        'Identificacion',
        'Direccion',
        'Telefono',
        'TipoPago',
        'Email',
        'FechaHoraPago',
        'TotalPago'
    ];

    //Relacion muchos a muchos 

    public function DetallePago(){ //Realiza la relacion
        return $this->belongsToMany(Video::class, 'detallespagos', 'idPago', 'idVideo')->withPivot('PrecioPago','CreacionDetPag'); //Relacion n a n con Video
    }

    //Relacion 1 a n inversa Clientes
    public function Clientes(){ //Realiza la relacion
        return $this->belongsTo(Cliente::class, 'idCliente'); //Relacion n a 1 Cliente
    }
}
