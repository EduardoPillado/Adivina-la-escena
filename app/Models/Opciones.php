<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opciones extends Model
{
    use HasFactory;
    protected $guard_name = 'web';
    protected $table="opciones";
    protected $primaryKey='pkOpciones';
    protected $fillable = [
        'nombreOpcion',
        'fkMultimedia',
        'estatusOpcion'
    ];
    public $timestamps=false;
    public function multimedia(){
        return $this->belongsTo(Multimedia::class, 'fkMultimedia');
    }
}
