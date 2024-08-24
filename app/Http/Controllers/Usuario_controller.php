<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

use function Laravel\Prompts\alert;

class Usuario_controller extends Controller
{
    public function login(Request $req) {
        $this->validate($req, [
            'nombreUsuario' => 'required',
            'contraseña' => 'required',
        ]);
    
        $credentials = $req->only('nombreUsuario', 'contraseña');
    
        $usuario = $this->obtenerUsuarioPorNombre($credentials['nombreUsuario']);
    
        if ($usuario && Hash::check($credentials['contraseña'], $usuario[0]->contraseña)) {
            if ($usuario[0]->estatusUsuario == 1) {
                session(['pkUsuario' => $usuario[0]->pkUsuario, 'nombreUsuario' => $usuario[0]->nombreUsuario, 'tipoUsuario' => $usuario[0]->fkTipoUsuario]);
                return redirect('/inicio')->with('success', 'Bienvenido');
            } else {
                return redirect('/login')->with('error', 'Usuario dado de baja');
            }
        } else {
            return redirect('/login')->with('error', 'Datos incorrectos');
        }
    }

    private function obtenerUsuarioPorNombre($nombreUsuario){
        $usuario = DB::select('CALL usuario_crud(?, ?, NULL, NULL, NULL, NULL, NULL, NULL)', array('login', $nombreUsuario));
        return $usuario;
    }

    public function logout() {
        session()->forget(['pkUsuario', 'nombreUsuario', 'tipoUsuario', 'escenasPremezcladas', 'contador_escenas', 'contador_niveles']);
        return redirect('/inicio')->with('success', 'Sesión cerrada');
    }
    
    /*funcion agregar usuario en la base de datos*/
    public function agregar(Request $req)
    {
        $this->validate($req, [
            'nombreUsuario' => 'required|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ0-9 ]+$/',
            'contraseña' => 'required|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ0-9 ]+$/',
            'correo' => 'required|email',
        ]);

        $nombreUsuario = $req->input('nombreUsuario');
        $contrasena = Hash::make($req->input('contraseña'));
        $correo = $req->input('correo');
        $estatusUsuario = 0;
        $token = md5($correo);

        // Agregar usuario
        $usuario = DB::select('CALL usuario_crud(?, ?, ?, NULL, ?, ?, ?,?)', array('agregar', $nombreUsuario, $contrasena, 1, $correo, $estatusUsuario, $token));

        $fecha = date('Y-m-d', strtotime('15-05-2024'));

        // Insertar registro en el log
        DB::statement('CALL InsertarLog(?, ?, ?, ?, ?,?)', array($fecha, $nombreUsuario, "Registro de nuevo usuario administrador", "Formulario de Registro", "1", "11"));

        // Enviar correo electrónico
        $this->enviarCorreo($correo,$token);

        // Redireccionar a la página de éxito
        return redirect()->route('mensajito');
        
    }

    public function enviarCorreo($correo, $token)
    {
        $titulo = 'POR FAVOR AYUDANOS A VERIFICAR TU E-MAIL';

        $mensaje = '
            <html>
            <head>
            <meta charset="UTF-8">
            <title>VERIFICACION DE E-MAIL</title>
            </head>
            <body>
            <p>Haz click en el siguiente enlace para verificar tu email</p>
            <a href="' . route('verificar', ['token' => urlencode($token), 'correo' => urlencode($correo)]) . '">VERIFICAR</a>
            </body>
            </html>
        ';
        // Enviar correo electrónico
        Mail::html($mensaje, function ($message) use ($correo, $titulo) {
            $message->to($correo)->subject($titulo);
        });

        return 'Correo enviado correctamente.';
    }

    public function correoContraseña(Request $req)
    {
        $titulo = 'Recuperacion de contraseña';
        $correito= urldecode($req->correo);
        $mensaje = '
            <html>
            <head>
            <meta charset="UTF-8">
            <title>VERIFICACION DE E-MAIL</title>
            </head>
            <body>
            <p>Haz click en el siguiente enlace para cambiar tu contraseña</p>
            <a href="' . route('recuperar.formulario', [ 'correo' => urlencode($correito)]) . '">Cambio contraseña</a>
            </body>
            </html>
        ';

        // Enviar correo electrónico
        Mail::html($mensaje, function ($message) use ($correito, $titulo) {
            $message->to($correito)->subject($titulo);
        });
         // Redireccionar a la página de éxito
         return redirect()->route('mensajito2');
    }

    public function verificar(Request $request)
    {
        // Obtener los parámetros token y correo del request
        $token = $request->token;
        $correo = urldecode($request->correo);
            
        // Consultar la base de datos para verificar la existencia del token y el correo
        $usuario = Usuario::where('token', $token)->where('correo', $correo)->first();
        
        // Actualizar el estado del usuario de 0 a 1
        $usuario->estatusUsuario = 1;
        $usuario->save();
        if ($usuario->pkUsuario) {
            return redirect('/login')->with('success', 'Usuario Confirmado , Inicia Sesión');
        } else {
            return redirect('/login')->with('error', 'Error en confirmacion de usuario');
        }  
    }
    
    public function agregarUsuario(Request $req)
    {
        $this->validate($req, [
            'nombreUsuario' => 'required|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ0-9 ]+$/',
            'contraseña' => 'required|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ0-9 ]+$/',
            'correo' => 'required|email',
        ]);

        $nombreUsuario = $req->input('nombreUsuario');
        $contrasena = Hash::make($req->input('contraseña'));
        $correo = $req->input('correo');
        $estatusUsuario = 0; // Establecer el estatus del usuario a 0
        $token = md5($correo);
        
        // Agregar usuario
        $usuario = DB::select('CALL usuario_crud(?, ?, ?, NULL, ?, ?, ?,?)', array('agregar', $nombreUsuario, $contrasena, 2, $correo, $estatusUsuario, $token));
        $fecha = date('Y-m-d', strtotime('15-05-2024'));

        // Insertar registro en el log
        DB::statement('CALL InsertarLog(?, ?, ?, ?, ?,?)', array($fecha, $nombreUsuario, "Registro de nuevo usuario", "Formulario de Registro", "1", "11"));

        // Enviar correo electrónico
        $this->enviarCorreo($correo,$token);

        // Redireccionar a la página de éxito
        return redirect()->route('mensajito');
    }
    public function actualizarContraseña(Request $req, $correo)
    {
        $this->validate($req, [
            'contraseña' => 'nullable|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ0-9 ]+$/',
          
        ]);

        $contrasena = $req->filled('contraseña') ? Hash::make($req->input('contraseña')) : null;
      
        $resultado = DB::select('CALL usuario_crud(?, NULL, ?, NULL, NULL, ?, NULL,NULL)', array('updatePassword', $contrasena, $correo));
     
        return redirect(url('/login'))->with('success', '¡Recuperacion de contraseña completada!');
        
    }
    
    /*funcion actualizar usuario en la base de datos*/
    public function actualizar(Request $req, $token)
    {
        $nombreUsuario = $req->input('nombreUsuario');
        $contrasena = $req->filled('contraseña') ? Hash::make($req->input('contraseña')) : null;
        $fkTipoUsuario = $req->input('fkTipoUsuario');
        $correo = $req->input('correo');
        $estatusUsuario = 1;
        
        try {
            $resultado = DB::select('CALL usuario_crud(?, ?, ?, NULL, ?, ?, ?,?)', array('actualizar', $nombreUsuario, $contrasena, $fkTipoUsuario, $correo, $estatusUsuario, $token));
            return redirect(url('/allUsers'))->with('success', '¡Actualización de usuario completada!');
        } catch (\Exception $e) {
            return redirect(url('/allUsers'))->with('error', 'Error en la actualización de usuario: ' . $e->getMessage());
        }
    }

    /*funcion baja usuario en la base de datos*/
    public function baja(Request $req, $token)
    {
        $PKUSUARIO = session('pkUsuario');
        if ($PKUSUARIO) {
            $tipoUsuario = session('tipoUsuario');
            if ($tipoUsuario == 1) {
                $usuario=DB::select('CALL usuario_crud(?, NULL, NULL, NULL, NULL, NULL, NULL,?)', array('baja', $token));

                try {
                    return redirect(url('/allUsers'))->with('success', '¡Baja de Usuario Completada!');
                } catch (\Exception $e) {
                    return redirect(url('/allUsers'))->with('error', 'Error en Baja de Usuario');
                }
            } else {
                return redirect('/inicio');
            }
        } else {
            return redirect('/inicio');
        }
    }

    /*funcion mostrar todos los usuarios  en la base de datos*/
    public function mostrarUsuariosGeneral()
    {
        $PKUSUARIO = session('pkUsuario');
        if ($PKUSUARIO) {
            $tipoUsuario = session('tipoUsuario');
            if ($tipoUsuario == 1) {
                $usuarios = DB::select('CALL usuario_crud("mostrarUsuariosGeneral", NULL, NULL, NULL, NULL, NULL, NULL, NULL)');
                return view('listaUsuarios', ['datosUsuarios' => $usuarios]);
            } else {
                return redirect('/inicio');
            }
        } else {
            return redirect('/inicio');
        }
    }
    
    public function mostrarUsuarioPorId($token, $vista = "editarUsuario")
    {
        $PKUSUARIO = session('pkUsuario');
        if ($PKUSUARIO) {
            $tipoUsuario = session('tipoUsuario');
            if ($tipoUsuario == 1) {
                $usuario = DB::select('CALL usuario_crud("mostrarUsuarioPorId", NULL, NULL, NULL, NULL, NULL, NULL, ?)', array($token));
                return view($vista, ['dato' => $usuario]);
            } else {
                return redirect('/inicio');
            }
        } else {
            return redirect('/inicio');
        }
    }
    
    public function contacto(Request $req)
    {
        $titulo = $req->proposito;
        $correo = $req->correo;
        $mensaje = '
            <html>
            <head>
            <meta charset="UTF-8">
            <title>' . $req->proposito . '</title>
            </head>
            <body>
            <p>' . $req->mensaje . '</p>
           
            </body>
            </html>
        ';
    
        // Enviar correo electrónico
        Mail::html($mensaje, function ($message) use ($correo, $titulo) {
            $message->to($correo)->subject($titulo);
        });
    
        // Redireccionar a la página de éxito
        return back()->with('success', 'Mensaje Enviado');
    }
  
}
