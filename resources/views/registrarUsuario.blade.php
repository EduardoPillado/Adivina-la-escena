<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('img/LOGOTIPO.ico') }}" rel="icon">
    <title>Registro administrador</title>
    {{-- SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- Tailwind --}}
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Comic+Sans+MS&display=swap" rel="stylesheet">
    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css') }}">
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
            height: 100%;
            margin: 0;
        }
    </style>
</head>
<body oncopy="return false" onpaste="return false" class="bg-cover pt-0 pb-0 bg-center bg-repeat font-comic-sans font-bold fondo-opaco-amarillo">

    @include('mensaje')

    <div class="zone3"></div>

    <div class="flex flex-col sm:flex-row justify-center space-x-0 sm:space-x-10 mb-8">
        <a href="{{ route('administrador') }}">
            <div title="Regresar" class="back-button">
                <i class="bi bi-arrow-90deg-left"></i>
            </div>
        </a>
    </div>
    
    <div class="register-container bg-yellow-100 p-8 rounded-lg mx-auto max-w-lg">
        <h2 class="text-xl font-bold mb-4 text-center">Registro</h2>
        <form id="formulario" action="{{ route('usuario.insertar') }}" enctype="multipart/form-data" method="post">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="usuario">
                    Usuario
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="nombreUsuario" id="usuario" type="text" placeholder="Ingresa tu usuario" pattern="^[a-zA-Z0-9_]*$" title="El nombre de usuario solo puede contener letras, números y guiones bajos." autocomplete="off" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="correo">
                    Correo
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="correo" name="correo" type="email" placeholder="Ingresa tu correo electrónico" autocomplete="off" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="confirmar_correo">
                    Confirmar correo
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="correo" name="correo" type="email" placeholder="Ingresa tu correo electrónico" autocomplete="off" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="contrasena">
                    Contraseña
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="contraseña" id="contrasena" type="password" placeholder="Ingresa tu contraseña" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Debe contener al menos un número, una letra mayúscula, una letra minúscula y al menos 8 o más caracteres" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="confirmar_contrasena">
                    Confirmar Contraseña
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="confirmar_contraseña" id="confirmar_contrasena" type="password" placeholder="Confirma tu contraseña" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Debe contener al menos un número, una letra mayúscula, una letra minúscula y al menos 8 o más caracteres" required>
            </div>
            <div class="flex items-center justify-center">
                <button class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Registrarse
                </button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('formulario').addEventListener('submit', function(event) {
            var contraseña = document.getElementById('contrasena').value;
            var correo = document.getElementById('correo').value;
            var confirmar_contrasena = document.getElementById('confirmar_contrasena').value;
            var confirmar_correo = document.getElementById('confirmar_correo').value;
    
            if (contraseña !== confirmar_contrasena) {
                event.preventDefault();
                alert('Las contraseñas no coinciden.');
            }
            if (correo !== confirmar_correo) {
                event.preventDefault();
                alert('Los correos no coinciden.');
            }
        });
    </script>

</body>
</html>