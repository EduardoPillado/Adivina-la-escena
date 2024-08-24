<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;

class Categoria_controller extends Controller
{
    public function insertar(Request $req){
        $categoria=new Categoria();
        
        $categoria->nombreCategoria=$req->nombreCategoria;

        $categoria->save();
        
        if ($categoria->pkCategoria) {
            return back()->with('success', 'Guardado');
        } else {
            return back()->with('error', 'Hay algún problema con la información');
        }
    }

    public function mostrar(){
        $PKUSUARIO = session('pkUsuario');
        if ($PKUSUARIO) {
            $tipoUsuario = session('tipoUsuario');
            if ($tipoUsuario == 1) {
                $datosCategoria=Categoria::all();
                return view('listaCategorias', compact('datosCategoria'));
            } else {
                return redirect('/');
            }
        } else {
            return redirect('/');
        }
    }
}
