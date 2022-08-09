<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publicidad extends Model
{
    protected $table = 'publicidades';
    protected $primaryKey = 'idPublicidad';
    public $timestamps = false;
    use HasFactory;
    protected $fillable=['PortadaPub', 'DescripcionPub', 'UrlPub'];
}
