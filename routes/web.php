<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Usuario_controller;
use App\Http\Controllers\Categoria_controller;
use App\Http\Controllers\Multimedia_controller;
use App\Http\Controllers\Opciones_controller;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('inicio');
})->name('inicio');

Route::get('/mesajito', function () {
    $PKUSUARIO = session('pkUsuario');
    if ($PKUSUARIO) {
        return view('mensajito');
    } else {
        return redirect('/');
    }
})->name('mensajito');

Route::get('/mesajitoPassword', function () {
    $PKUSUARIO = session('pkUsuario');
    if ($PKUSUARIO) {
        return view('mensajito2');
    } else {
        return redirect('/');
    }
})->name('mensajito2');

Route::get('/contactaDevelopers', function () {
    return view('contactanos');
})->name('contact');

Route::get('/adminsZone', function () {
    $PKUSUARIO = session('pkUsuario');
    if ($PKUSUARIO) {
        $tipoUsuario = session('tipoUsuario');
        if ($tipoUsuario == 1) {
            return view('adminSection');
        } else {
            return redirect('/');
        }
    } else {
        return redirect('/');
    }
})->name('administrador');

Route::get('/perfil', function () {
    $PKUSUARIO = session('pkUsuario');
    if ($PKUSUARIO) {
        return view('profileUser');
    } else {
        return redirect('/');
    }
})->name('profile');

Route::post('/enviarMensaje', [Usuario_controller::class,"contacto"])->name('usuario.contacto');

// Usuario ----------------------------------------------------------------------------------------------------------------------
Route::get('/aggUser', function () {
    $PKUSUARIO = session('pkUsuario');
    if ($PKUSUARIO) {
        $tipoUsuario = session('tipoUsuario');
        if ($tipoUsuario == 1) {
            return view('registrarUsuario');
        } else {
            return redirect('/');
        }
    } else {
        return redirect('/');
    }
})->name('registroUsuario');
Route::get('/aggCommonUser', function () {
    return view('registrarCommmonUsuario');
})->name('registroUsuarioComun');
Route::get('/allUsers', function () {
    return view('listaUsuarios');
})->name('allUsers');

Route::get('/updatePassword', function () {
    return view('recuperacionPassword');
})->name('recuperar.password');
Route::get('/cambioPass/{correo}', function ($correo) {
    return view('cambioPassword', ['correo' => $correo]);
})->name('recuperar.formulario');

Route::post('/aggNewUser', [Usuario_controller::class,"agregar"])->name('usuario.insertar');
Route::post('/recoverPassword', [Usuario_controller::class,"correoContraseña"])->name('usuario.recuperar');
Route::post('/passwordChange/{correo}', [Usuario_controller::class,"actualizarContraseña"])->name('usuario.change');
Route::post('/aggNewCommonUser', [Usuario_controller::class,"agregarUsuario"])->name('usuarioCommon.insertar');
Route::get('/allUsers', [Usuario_controller::class,"mostrarUsuariosGeneral"])->name('usuario.mostrar');
Route::get('/idUser/{token}/{vista?}', [Usuario_controller::class,"mostrarUsuarioPorId"])->name('usuario.mostrarPorId');
Route::post('/updateUser/{token}', [Usuario_controller::class,"actualizar"])->name('usuario.actualizar');
Route::get('/deleteUser/{token}', [Usuario_controller::class,"baja"])->name('usuario.baja');

Route::get('/verificar/{token}/{correo}', [Usuario_controller::class,"verificar"])->name('verificar');

Route::get('/login', function () {
    return view('login');
})->name('login');
Route::post('/inicioSesion', [Usuario_controller::class, 'login'])->name('inicioSesion');
Route::get('/cerrarSesion', [Usuario_controller::class, 'logout'])->name('cerrarSesion');

// Categoria --------------------------------------------------------------------------------------------------------------------
Route::get('/aggCat', function () {
    $PKUSUARIO = session('pkUsuario');
    if ($PKUSUARIO) {
        $tipoUsuario = session('tipoUsuario');
        if ($tipoUsuario == 1) {
            return view('formCategorias');
        } else {
            return redirect('/');
        }
    } else {
        return redirect('/');
    }
})->name('agregarCategoria');
Route::get('/categorias', function () {
    return view('listaCategorias');
})->name('categorias');

Route::get('/selecciónDeCategoría', function () {
    $PKUSUARIO = session('pkUsuario');
    if ($PKUSUARIO) {
        return view('seleccionDeCategoria');
    } else {
        return redirect('/');
    }
})->name('categoria.seleccion');

Route::post('/registroCategoria', [Categoria_controller::class, 'insertar'])->name('categoria.insertar');

Route::get('/categorias', [Categoria_controller::class, 'mostrar'])->name('categoria.mostrar');

// Escena a adivinar ------------------------------------------------------------------------------------------------------------
Route::get('/aggMul', function () {
    $PKUSUARIO = session('pkUsuario');
    if ($PKUSUARIO) {
        $tipoUsuario = session('tipoUsuario');
        if ($tipoUsuario == 1) {
            return view('formMultimedia');
        } else {
            return redirect('/');
        }
    } else {
        return redirect('/');
    }
})->name('agregarMultimedia');
Route::get('/juego', function () {
    return view('juegoOpciones');
})->name('opcionesEscena');


Route::post("/registroMultimedia",[Multimedia_controller::class,"insertar"])->name("multimedia.insertar");
Route::get('/escenitas', [Multimedia_controller::class, 'mostrar'])->name('multimedia.mostrar');
Route::get('/escena/{pkMultimedia}', 'VideoController@show')->name('videos.show');
Route::post('/opciones-escena', [Multimedia_controller::class, 'opcionesEscena'])->name('opciones-escena');
Route::post('/verificar-respuesta', [Opciones_controller::class, 'verificarRespuesta'])->name('verificarRespuesta');
Route::match(['get', 'put'], '/escena/{pkMultimedia}', [Multimedia_controller::class, 'baja'])->name('multimedia.baja');
Route::get('/escena/{pkMultimedia}/update', [Multimedia_controller::class, 'mostrarPorId'])->name('multimedia.mostrarPorId');
Route::put('/escena/{pkMultimedia}/updote', [Multimedia_controller::class, 'actualizar'])->name('multimedia.actualizar');

// Rutas de modos de juego
Route::get('/escenaAdivinarDemo', [Multimedia_controller::class, 'escenaDemo'])->name('multimedia.demo');
Route::get('/escenaAdivinarAleatorio/{modo}', [Multimedia_controller::class, 'escenaAleatorio'])->name('multimedia.aleatorio');
Route::get('/escenaAdivinarPelicula', [Multimedia_controller::class, 'escenaPelicula'])->name('multimedia.pelicula');
Route::get('/escenaAdivinarSerie', [Multimedia_controller::class, 'escenaSerie'])->name('multimedia.serie');
Route::get('/escenaAdivinarVideojuego', [Multimedia_controller::class, 'escenaVideojuego'])->name('multimedia.videojuego');



Route::get('/error', function () {
    return view('error');
})->name('error');