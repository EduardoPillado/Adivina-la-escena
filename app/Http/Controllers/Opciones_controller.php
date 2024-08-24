<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Opciones;
use App\Models\Multimedia;
use Illuminate\Support\Str;


class Opciones_controller extends Controller
{
    public function index()
    {
        $opciones = Opciones::all();
        return view('opciones.index', compact('opciones'));
    }

    public function create()
    {
        return view('opciones.create');
    }

    public function store(Request $request)
    {
        $opcion = new Opciones();
        $opcion->nombreOpcion = $request->nombreOpcion;
        $opcion->fkMultimedia = $request->fkMultimedia;
        $opcion->estatusOpcion = $request->estatusOpcion;
        $opcion->save();

        return redirect('/opciones');
    }

    public function show($id)
    {
        $opcion = Opciones::findOrFail($id);
        $opciones = Opciones::where('pkOpciones', '!=', $id)->inRandomOrder()->limit(3)->get();
        $opciones->push($opcion);
        $opciones = $opciones->shuffle();
        return view('juegoOpciones', compact('opcion', 'opciones'));
    }


    public function verificarRespuesta(Request $request)
    {
        // Obtener el número del botón seleccionado
        $selectedButtonNumber = null;
        for ($i = 1; $i <= 4; $i++) {
            if ($request->has('opcion_elegida_' . $i)) {
                $selectedButtonNumber = $i;
                break;
            }
        }
   
        // Si se encontró un botón seleccionado
        if ($selectedButtonNumber !== null) {
            // Obtener el valor del botón seleccionado
            $estatusOpcionSeleccionada = $request->input('opcion_elegida_' . $selectedButtonNumber);

            // Tu lógica de verificación aquí
            if ($estatusOpcionSeleccionada == '1') {
                return redirect()->route('multimedia.aleatorio', ['modo' => 1])->with('success', 'CORRECTO');
            } else {
                $nivel = session()->get('contador_niveles');
                session()->forget('escenasPremezcladas');
                session()->forget('contador_escenas');
                session()->forget('contador_niveles');
                return redirect()->route('inicio')->with('error', "Respuesta incorrecta, Llegaste al nivel $nivel");
            }
        } else {
            // Manejo si no se seleccionó ninguna opción
            $nivel = session()->get('contador_niveles');
            session()->forget('escenasPremezcladas');
            session()->forget('contador_escenas');
            session()->forget('contador_niveles');
            return redirect()->route('inicio')->with('error', "No se seleccionó ninguna opción, Llegaste al nivel $nivel");
        }
    }

    public function edit($id)
    {
        $PKUSUARIO = session('pkUsuario');
        if ($PKUSUARIO) {
            $tipoUsuario = session('tipoUsuario');
            if ($tipoUsuario == 1) {
                $opcion = Opciones::findOrFail($id);
                return view('opciones.edit', compact('opcion'));
            } else {
                return redirect('/');
            }
        } else {
            return redirect('/');
        }
    }

    public function update(Request $request, $id)
    {
        $opcion = Opciones::findOrFail($id);
        $opcion->nombreOpcion = $request->nombreOpcion;
        $opcion->fkMultimedia = $request->fkMultimedia;
        $opcion->estatusOpcion = $request->estatusOpcion;
        $opcion->save();

        return redirect('/opciones');
    }

    public function destroy($id)
    {
        $opcion = Opciones::findOrFail($id);
        $opcion->delete();

        return redirect('/opciones');
    }
}