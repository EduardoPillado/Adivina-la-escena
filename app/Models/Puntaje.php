<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Puntaje extends Model
{
    use HasFactory;
    protected $guard_name = 'web';
    protected $table="puntaje";
    protected $primaryKey='pkPuntaje';
    protected $fillable = [
        'cantidadPuntos',
        'fkCategoria',
        'fkUsuario'
    ];
    public $timestamps=false;
    public function categoria(){
        return $this->belongsTo(Categoria::class, 'fkCategoria');
    }
    public function usuario(){
        return $this->belongsTo(Usuario::class, 'fkUsuario');
    }
}
