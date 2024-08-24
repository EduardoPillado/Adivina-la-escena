<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Multimedia;
use App\Models\Opciones;

class Multimedia_controller extends Controller
{
    public function insertar(Request $req) {
        if ($req->hasFile('nombreMultimedia')) {
            $multimedia = new Multimedia();

            $video = $req->file('nombreMultimedia');
            $originalName = $video->getClientOriginalName();
            $newName = pathinfo($originalName, PATHINFO_FILENAME) . '.mp4';
            $pathMultimedia = $video->storeAs('escenas', $newName, 'public');
            $multimedia->nombreMultimedia = $pathMultimedia;

            $multimedia->fkCategoria = $req->fkCategoria;
            $multimedia->estatusMultimedia = 1;
            $multimedia->save();

            $opcion1 = new Opciones();
            $opcion1->nombreOpcion = $req->nombreOpcion1;
            $opcion1->fkMultimedia = $multimedia->pkMultimedia;
            $opcion1->estatusOpcion = 1;
            $opcion1->save();

            $opcion2 = new Opciones();
            $opcion2->nombreOpcion = $req->nombreOpcion2;
            $opcion2->fkMultimedia = $multimedia->pkMultimedia;
            $opcion2->estatusOpcion = 0;
            $opcion2->save();

            $opcion3 = new Opciones();
            $opcion3->nombreOpcion = $req->nombreOpcion3;
            $opcion3->fkMultimedia = $multimedia->pkMultimedia;
            $opcion3->estatusOpcion = 0;
            $opcion3->save();

            $opcion4 = new Opciones();
            $opcion4->nombreOpcion = $req->nombreOpcion4;
            $opcion4->fkMultimedia = $multimedia->pkMultimedia;
            $opcion4->estatusOpcion = 0;
            $opcion4->save();
    
            if ($multimedia->pkMultimedia) {
                if ($opcion1->pkOpciones) {
                    if ($opcion2->pkOpciones) {
                        if ($opcion3->pkOpciones) {
                            if ($opcion4->pkOpciones) {
                                return back()->with('success', 'Guardado');
                            } else {
                                return back()->with('error', 'Hay algún problema con la opción 4');
                            }
                        } else {
                            return back()->with('error', 'Hay algún problema con la opción 3');
                        }
                    } else {
                        return back()->with('error', 'Hay algún problema con la opción 2');
                    }
                } else {
                    return back()->with('error', 'Hay algún problema con la opción 1');
                }
            } else {
                return back()->with('error', 'Hay algún problema con los datos de la escena');
            }
        } else {
            return back()->with('error', 'Por favor selecciona un archivo.');
        }
    }

    public function mostrar(){
        $PKUSUARIO = session('pkUsuario');
        if ($PKUSUARIO) {
            $tipoUsuario = session('tipoUsuario');
            if ($tipoUsuario == 1) {
                $datosMultimedia=Multimedia::where('estatusMultimedia', '=', 1)->get();
                return view('listaEscenas', compact('datosMultimedia'));
            } else {
                return redirect('/');
            }
        } else {
            return redirect('/');
        }
    }

    public function escenaDemo()
    {
        // Verificar si el arreglo de escenas premezcladas ya está guardado en la sesión
        $escenasPremezcladas = session()->get('escenasPremezcladas');

        // Si no está guardado, generar el arreglo de escenas premezcladas y guardarlo en la sesión
        if (!$escenasPremezcladas) {
            $escenasPremezcladas = Multimedia::inRandomOrder()->limit(10)->get(); // Limitar a 10 escenas
            session()->put('escenasPremezcladas', $escenasPremezcladas);
        }

        // Obtener el contador de la sesión (o iniciar en 0 si no existe)
        $contador = session()->get('contador_escenas', 0);

        // Si el contador es igual al tamaño del arreglo, mostrar el mensaje de "Juego ganado" y reiniciar el contador
        if ($contador == count($escenasPremezcladas)) {
            // Eliminar el arreglo de escenas premezcladas de la sesión
            session()->forget('escenasPremezcladas');
            session()->forget('contador_escenas');
            session()->forget('contador_niveles');
            return redirect()->route('inicio')->with('success', 'Juego ganado');
        }

        // Obtener la escena actual según el contador
        $multimedia = $escenasPremezcladas[$contador];

        // Incrementar las reproducciones de la escena seleccionada
        $multimedia->increment('reproducciones');

        // Incrementar el contador para la próxima vez
        $contador++;

        // Guardar el contador en la sesión
        session()->put('contador_escenas', $contador);

        // Mostrar la escena actual
        return view('escenaAdivinar', ['multimedia' => $multimedia]);
    }

    public function escenaAleatorio($modo)
    {
        // Verificar si el arreglo de escenas premezcladas ya está guardado en la sesión
        $escenasPremezcladas = session()->get('escenasPremezcladas');

        if (!$escenasPremezcladas) {
            if ($modo == 1) {
                $escenasPremezcladas = Multimedia::where('fkCategoria', 1)->inRandomOrder()->get();
            } elseif ($modo == 2) {
                $escenasPremezcladas = Multimedia::where('fkCategoria', 2)->inRandomOrder()->get();
            } elseif ($modo == 3) {
                $escenasPremezcladas = Multimedia::where('fkCategoria', 3)->inRandomOrder()->get();
            } elseif ($modo == 4) {
                $escenasPremezcladas = Multimedia::inRandomOrder()->get();
            } elseif ($modo == 5) {
                $escenasPremezcladas = Multimedia::inRandomOrder()->limit(10)->get();
            }
            session()->put('escenasPremezcladas', $escenasPremezcladas);
        }
        
        // Obtener el contador de la sesión (o iniciar en 0 si no existe)
        $contador = session()->get('contador_escenas', 0);

        // Si el contador es igual al tamaño del arreglo, mostrar el mensaje de "Juego ganado" y reiniciar el contador
        if ($contador == count($escenasPremezcladas)) {
            // Eliminar el arreglo de escenas premezcladas de la sesión
            session()->forget('escenasPremezcladas');
            session()->forget('contador_escenas');
            session()->forget('contador_niveles');
            return redirect()->route('inicio')->with('success', 'Juego ganado');
        }

        // Obtener la escena actual según el contador
        $multimedia = $escenasPremezcladas[$contador];

        // Incrementar las reproducciones de la escena seleccionada
        $multimedia->increment('reproducciones');

        // Incrementar el contador para la próxima vez
        $contador++;

        // Guardar el contador en la sesión
        session()->put('contador_escenas', $contador);

        // Mostrar la escena actual
        return view('escenaAdivinar', ['multimedia' => $multimedia]);
    }

    public function escenaPelicula()
    {
        // Verificar si el arreglo de escenas premezcladas ya está guardado en la sesión
        $escenasPeliculas = session()->get('escenasPeliculas');

        // Si no está guardado, generar el arreglo de escenas premezcladas de la categoría 'Películas' y guardarlo en la sesión
        if (!$escenasPeliculas) {
            $escenasPeliculas = Multimedia::where('fkCategoria', 1)->inRandomOrder()->get();

            session()->put('escenasPeliculas', $escenasPeliculas);
        }

        // Obtener el contador de la sesión (o iniciar en 0 si no existe)
        $contador = session()->get('contador_escenas_peliculas', 0);

        // Si el contador es igual al tamaño del arreglo, mostrar el mensaje de "Juego ganado" y reiniciar el contador
        if ($contador == count($escenasPeliculas)) {
            // Eliminar el arreglo de escenas premezcladas de la sesión
            session()->forget('escenasPeliculas');
            session()->forget('contador_escenas_peliculas');
            return redirect()->route('inicio')->with('success', 'Juego ganado');
        }

        // Obtener la escena actual según el contador
        $multimedia = $escenasPeliculas[$contador];

        // Incrementar las reproducciones de la escena seleccionada
        $multimedia->increment('reproducciones');

        // Incrementar el contador para la próxima vez
        $contador++;

        // Guardar el contador en la sesión
        session()->put('contador_escenas_peliculas', $contador);

        // Mostrar la escena actual
        return view('escenaAdivinar', ['multimedia' => $multimedia]);
    }

    public function escenaSerie()
    {
        // Verificar si el arreglo de escenas premezcladas ya está guardado en la sesión
        $escenasSeries = session()->get('escenasSeries');

        // Si no está guardado, generar el arreglo de escenas premezcladas de la categoría 'Películas' y guardarlo en la sesión
        if (!$escenasSeries) {
            $escenasSeries = Multimedia::where('fkCategoria', 2)->inRandomOrder()->get();

            session()->put('escenasSeries', $escenasSeries);
        }

        // Obtener el contador de la sesión (o iniciar en 0 si no existe)
        $contador = session()->get('contador_escenas_series', 0);

        // Si el contador es igual al tamaño del arreglo, mostrar el mensaje de "Juego ganado" y reiniciar el contador
        if ($contador == count($escenasSeries)) {
            // Eliminar el arreglo de escenas premezcladas de la sesión
            session()->forget('escenasSeries');
            session()->forget('contador_escenas_series');
            return redirect()->route('inicio')->with('success', 'Juego ganado');
        }

        // Obtener la escena actual según el contador
        $multimedia = $escenasSeries[$contador];

        // Incrementar las reproducciones de la escena seleccionada
        $multimedia->increment('reproducciones');

        // Incrementar el contador para la próxima vez
        $contador++;

        // Guardar el contador en la sesión
        session()->put('contador_escenas_series', $contador);

        // Mostrar la escena actual
        return view('escenaAdivinar', ['multimedia' => $multimedia]);
    }

    public function escenaVideojuego()
    {
        // Verificar si el arreglo de escenas premezcladas ya está guardado en la sesión
        $escenasVideojuegos = session()->get('escenasVideojuegos');

        // Si no está guardado, generar el arreglo de escenas premezcladas de la categoría 'Películas' y guardarlo en la sesión
        if (!$escenasVideojuegos) {
            $escenasVideojuegos = Multimedia::where('fkCategoria', 3)->inRandomOrder()->get();
            
            session()->put('escenasVideojuegos', $escenasVideojuegos);
        }

        dd($escenasVideojuegos);

        // Obtener el contador de la sesión (o iniciar en 0 si no existe)
        $contador = session()->get('contador_escenas_videojuegos', 0);

        // Si el contador es igual al tamaño del arreglo, mostrar el mensaje de "Juego ganado" y reiniciar el contador
        if ($contador == count($escenasVideojuegos)) {
            // Eliminar el arreglo de escenas premezcladas de la sesión
            session()->forget('escenasVideojuegos');
            session()->forget('contador_escenas_videojuegos');
            return redirect()->route('inicio')->with('success', 'Juego ganado');
        }

        // Obtener la escena actual según el contador
        $multimedia = $escenasVideojuegos[$contador];

        // Incrementar las reproducciones de la escena seleccionada
        $multimedia->increment('reproducciones');

        // Incrementar el contador para la próxima vez
        $contador++;

        // Guardar el contador en la sesión
        session()->put('contador_escenas_videojuegos', $contador);

        // Mostrar la escena actual
        return view('escenaAdivinar', ['multimedia' => $multimedia]);
    }

    public function opcionesEscena(Request $request)
    {
        $multimediaId = $request->input('fkMultimedia');
        $multimedia = Multimedia::findOrFail($multimediaId);
        $opciones = $multimedia->opciones()->inRandomOrder()->limit(4)->get();
        
        return view('juegoOpciones', ['multimedia' => $multimedia, 'opciones' => $opciones]);
    }

    public function baja($pkMultimedia){
        $PKUSUARIO = session('pkUsuario');
        if ($PKUSUARIO) {
            $tipoUsuario = session('tipoUsuario');
            if ($tipoUsuario == 1) {
                $dato = Multimedia::findOrFail($pkMultimedia);

                if ($dato) {
                    $dato->estatusMultimedia = 0;
                    $dato->save();

                    return back()->with('success', 'Escena dada de baja');
                } else {
                    return back()->with('error', 'Hay algún problema con la información');
                }
            } else {
                return redirect('/');
            }
        } else {
            return redirect('/');
        }
    }

    public function mostrarPorId($pkMultimedia){
        $PKUSUARIO = session('pkUsuario');
        if ($PKUSUARIO) {
            $tipoUsuario = session('tipoUsuario');
            if ($tipoUsuario == 1) {
                $datosMultimedia = Multimedia::findOrFail($pkMultimedia);
                $datosOpciones = Opciones::where('fkMultimedia', $pkMultimedia)->get();
              
                return view('editarMultimedia', compact('datosMultimedia', 'datosOpciones'));
            } else {
                return redirect('/');
            }
        } else {
            return redirect('/');
        }
    }

    public function actualizar(Request $req, $pkMultimedia) {
        $datosMultimedia = Multimedia::findOrFail($pkMultimedia);

     
        // Actualizar nombreMultimedia si se ha subido un nuevo video
        if ($req->hasFile('nombreMultimedia')) {
            $video = $req->file('nombreMultimedia');
            $originalName = $video->getClientOriginalName();
            $newName = pathinfo($originalName, PATHINFO_FILENAME) . '.mp4';
            $pathMultimedia = $video->storeAs('escenas', $newName, 'public');
            $datosMultimedia->nombreMultimedia = $pathMultimedia;
        }
    
        // Actualizar categoría de la multimedia
        $datosMultimedia->fkCategoria = $req->fkCategoria;
        $datosMultimedia->estatusMultimedia = 1;
        $datosMultimedia->save();
    
        // Recorrer las opciones y actualizarlas
        for ($i = 0; $i < 4; $i++) {
            $opcion = Opciones::findOrFail($req->pkOpciones[$i]);
            $opcion->nombreOpcion = $req->input('nombreOpcion' . ($i + 1)); // Ajustar el índice para que comience desde 1
            $opcion->save();
        }
        
        
        // Retornar una respuesta de éxito
        return back()->with('success', 'Escena actualizada');
    }
}
