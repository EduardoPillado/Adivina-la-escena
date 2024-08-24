<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('img/LOGOTIPO.ico') }}" rel="icon">
    <title>Perfil de usuario</title>
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

    @php
        $Usuario = session('nombreUsuario');
    @endphp

    <div class="flex flex-col sm:flex-row justify-center space-x-0 sm:space-x-10 mb-8">
        <div class="profile-container">
            <div class="profile-column">
                <i class="bi bi-person-circle icon-profile"></i>
            </div>
            <div class="profile-column">
                <h1 class="user-container">{{ $Usuario }}</h1>
                <h3 style="font-size: 20px">Gracias por unirtenos!</h3>
            </div>
        </div>
    </div>

    @include('footer')

</body>
</html>