<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('img/LOGOTIPO.ico') }}" rel="icon">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Comic+Sans+MS&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    
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
    
    <title>Seguridad</title>
</head>
<body class="bg-cover pt-0 pb-0 bg-center bg-no-repeat font-comic-sans font-bold fondo-opaco-amarillo flex justify-center items-center h-screen">
    <form class="frm-w bg-yellow-100 p-8 rounded-lg max-w-md mx-auto"  action="{{ route('usuario.change', ['correo' => $correo]) }}"
 enctype="multipart/form-data" method="post" >
        @csrf
        <h1 class="text-2xl font-bold mb-4 text-center">Ingresa tu nueva contraseña {{$correo}}</h1>
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2" for="correo">
                Contraseña
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="pass" name="contraseña" placeholder="Ingresa tu contraseña" autocomplete="off" required>
        </div>
        <div class="flex items-center justify-center">
            <button class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
               Cambiar contraseña
            </button>
        </div>
    
    </form>
</body>
</html>