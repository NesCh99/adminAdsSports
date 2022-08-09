<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetaDato extends Model
{
    public $table = 'metadato';
    protected $primaryKey = 'idMetaDato';
    const CREATED_AT = 'CreacionMetaDato'; // personaliza el campo created_at
    const UPDATED_AT = 'ModificacionMetaDato'; // personaliza el campo updated_at
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'idVideo',
        'StreamKeyMetaDato',
        'LiveStreamIdMetaDato',
        'PlayerMetaDato',
        'CreacionMetaDato',
        'ModificacionMetaDato'
        //'EstadoMetaDato'
    ];

    //Relacion inversa uno a uno
    public function Video(){ //Realiza la relacion
        return $this->belongsTo(Video::class, 'idVideo');
    }
}
