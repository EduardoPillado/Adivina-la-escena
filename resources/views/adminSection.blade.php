<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('img/LOGOTIPO.ico') }}" rel="icon">
    <title>Panel administrador</title>
    <style>
        .fondo-opaco-amarillo {
            background-image: linear-gradient(rgba(255, 255, 0, 0.5), rgba(255, 255, 0, 0.5)), url('/img/fondo.png');
            background-size: cover;
            background-position: center;
        }

        html, body {
            height: 100vh;
            margin: 0;
            padding: 0;
        }

    </style>
</head>
<body class="bg-cover pt-0 pb-0 bg-center bg-repeat font-comic-sans font-bold fondo-opaco-amarillo">
    
    @include('mensaje')
    @include('header')

    <div class="flex flex-col sm:flex-row justify-center space-x-0 sm:space-x-10 mb-8">
        <a href="{{ route('registroUsuario') }}" class="enlace-seccion">
            Registrar usuario administrator
        </a>
        <a href="{{ route('agregarCategoria') }}" class="enlace-seccion">
            Agregar nueva categoría
        </a>
    </div>

    <div class="flex flex-col sm:flex-row justify-center space-x-0 sm:space-x-10 mb-8">
        <a href="{{ route('agregarMultimedia') }}" class="enlace-seccion">
            Agregar nueva escena y opciones
        </a>
    </div>

    <div class="flex flex-col sm:flex-row justify-center space-x-0 sm:space-x-10 mb-8">
        <a href="{{ ('/allUsers') }}" class="enlace-seccion">
            Usuarios registrados
        </a>
        <a href="{{ ('/categorias') }}" class="enlace-seccion">
            Categorías registradas
        </a>
    </div>

    <div class="flex flex-col sm:flex-row justify-center space-x-0 sm:space-x-10 mb-8">
            <a href="{{ route('multimedia.mostrar') }}" class="enlace-seccion">
            Escenas registradas
        </a>

    </div>

    @include('footer')

</body>
</html>