<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Multimedia extends Model
{
    use HasFactory;
    protected $guard_name = 'web';
    protected $table="multimedia";
    protected $primaryKey='pkMultimedia';
    protected $fillable = [
        'nombreMultimedia',
        'fkCategoria',
        'reproducciones',
        'estatusMultimedia'
    ];
    public $timestamps=false;
    public function categoria(){
        return $this->belongsTo(Categoria::class, 'fkCategoria');
    }
    public function opciones(){
        return $this->hasMany(Opciones::class, 'fkMultimedia');
    }
}
