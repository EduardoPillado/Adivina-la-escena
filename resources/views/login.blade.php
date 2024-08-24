<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('img/LOGOTIPO.ico') }}" rel="icon">
    <title>Login</title>
    {{-- SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- Tailwind --}}
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Comic+Sans+MS&display=swap" rel="stylesheet">
    {{-- CSS --}}
    <link rel="stylesheet" href="../css/estilo.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    
    <style>
        .fondo-opaco-amarillo {
            background-image: linear-gradient(rgba(255, 255, 0, 0.5), rgba(255, 255, 0, 0.5)), url('/img/fondo.png');
            background-size: cover;
            background-position: center;
        }
        
        html, body {
            height: 100vh;
            margin: 0;
        }
    </style>
</head>
<body oncopy="return false" onpaste="return false" class="bg-cover pt-0 pb-0 bg-center bg-repeat font-comic-sans font-bold fondo-opaco-amarillo">

    @include('mensaje')

    <div class="flex justify-center">
        <div class="login-container bg-yellow-100 p-4 sm:p-6 rounded-lg mb-8 mx-4 sm:mx-auto max-w-xl">
            <h2 class="text-xl font-bold mb-4 text-center">Iniciar sesión</h2>
            <form id="formulario" action="{{ url('/inicioSesion') }}" enctype="multipart/form-data" method="post">
                @csrf 
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                
                <div class="mb-4">
                    {{-- <label class="block text-gray-700 font-bold mb-2" for="usuario">Usuario</label> --}}
                    <input class="text-center shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="usuario" type="text" name="nombreUsuario" placeholder="Ingresa tu usuario" pattern="^[a-zA-Z0-9_]{1,}$" title="El nombre de usuario solo puede contener letras, números y guiones bajos." autocomplete="off" required>
                </div>
                <div class="mb-6">
                    {{-- <label class="block text-gray-700 font-bold mb-2" for="contraseña">Contraseña</label> --}}
                    <input class="text-center shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="contrasena" type="password" name="contraseña" placeholder="Ingresa tu contraseña" required>
                </div>
                <div class="mb-6">
                    {{-- <label class="block text-gray-700 font-bold mb-2" for="confirmar_contraseña">Confirmar Contraseña</label> --}}
                    <input class="text-center shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="confirmar_contrasena" type="password" name="confirmar_contraseña" placeholder="Confirma tu contraseña" required>
                </div>

                <div class="flex items-center justify-center">
                    <button class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">Iniciar sesión</button>
                </div>

                <div class="login-options-space"></div>
                
                <div class="flex items-center justify-center">
                    <a href="{{ route('registroUsuarioComun') }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Regístrate</a>
                </div>

                <div class="login-options-space"></div>
                
                <div class="flex items-center justify-center">
                    <p>
                        ¿Olvidaste tu contraseña?, recuperala 
                        <a class="text-black" href="{{ route('recuperar.password') }}">aquí</a>
                    </p>
                </div>
            </form>
        </div>
    </div>

</body>
</html>