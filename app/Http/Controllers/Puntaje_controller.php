<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Puntaje;

class Puntaje_controller extends Controller
{
    public function store(Request $request)
    {
        $puntaje = new Puntaje;
        $puntaje->cantidadPuntos = $request->input('puntos');
        $puntaje->fkCategoria = $request->input('categoria');
        $puntaje->fkUsuario = $request->input('usuario');
        $puntaje->save();

        return redirect('/juego');
    }
    public static function getPuntaje($usuarioId)
    {
        $puntaje = Puntaje::where('fkUsuario', $usuarioId)->first();
        return $puntaje ? $puntaje->cantidadPuntos : 0;
    }

}
