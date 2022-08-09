<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Administrador extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;
    protected $table = 'administradores';//reconoce el nombre de la tabla
    protected $primaryKey = 'idAdministrador';//reconoce el nombre del PK
    const CREATED_AT = 'CreacionAdm'; // personaliza el campo created_at
    const UPDATED_AT = 'ModificacionAdm'; // personaliza el campo updated_at


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'FechaCaducidadAdm',
        'NombreAdm',
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

    public function adminlte_desc(){
        return str_replace(array('"', '[', ']'),'',$this->getRoleNames());
    }

    public function adminlte_profile_url() {
        return url('/admin/administradores/'.$this->idAdministrador.'/editProfile');
    }
}
