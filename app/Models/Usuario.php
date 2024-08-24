<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Usuario extends Model
{
    use HasFactory;
    use HasRoles;
    protected $guard_name = 'web';
    protected $table="usuario";
    protected $primaryKey='pkUsuario';
    protected $fillable = [
        'nombreUsuario',
        'correo',
        'contraseña',
        'fkTipoUsuario',
        'estatusUsuario'
    ];
    public $timestamps=false;
    public function tipoUsuario(){
        return $this->belongsTo(TipoUsuario::class, 'fkTipoUsuario');
    }
}
