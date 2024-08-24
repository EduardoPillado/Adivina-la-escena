<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoUsuario extends Model
{
    use HasFactory;
    protected $guard_name = 'web';
    protected $table="tipoUsuario";
    protected $primaryKey='pkTipoUsuario';
    protected $fillable = [
        'nombreTipoUsuario'
    ];
    public $timestamps=false;
}
