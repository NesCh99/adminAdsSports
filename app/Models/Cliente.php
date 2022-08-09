<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    public $table = 'clientes';
    protected $primaryKey = 'idCliente';
    const CREATED_AT = 'CreacionCli'; // personaliza el campo created_at
    const UPDATED_AT = 'ModificacionCli'; // personaliza el campo updated_at
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'NombreCli',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //Relacion 1 a n Pagos

    public function Pagos(){ //Realiza la relacion
        return $this->hasMany(Pago::class, 'idCliente'); //Relacion 1 a n Pagos
    }

    //Relacion muchos a muchos 
    public function Suscripciones(){ //Realiza la relacion
        return $this->belongsToMany(Video::class, 'suscripciones', 'idCliente', 'idVideo')->withPivot('TipoSus'); //Relacion n a n Video
    }
}
