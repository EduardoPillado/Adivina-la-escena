<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;
    protected $guard_name = 'web';
    protected $table="categoria";
    protected $primaryKey='pkCategoria';
    protected $fillable = [
        'nombreCategoria'
    ];
    public $timestamps=false;
}
