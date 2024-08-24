<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('img/LOGOTIPO.ico') }}" rel="icon">
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
            height: 100%;
            margin: 0;
        }
    </style>
    
    <title>Contraseña</title>
</head>
<body class="bg-cover pt-0 pb-0 bg-center bg-no-repeat font-comic-sans font-bold fondo-opaco-amarillo flex justify-center items-center h-screen">
    <form class="frm-w bg-yellow-100 p-8 rounded-lg max-w-md mx-auto"  action="{{ route('usuario.recuperar') }}" enctype="multipart/form-data" method="post" >
        @csrf
        <h1 class="text-2xl font-bold mb-4 text-center">Ingresa tu correo electronico para enviarte un enlace de recuperacion de contraseña</h1>
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2" for="correo">
                Correo
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="correo" name="correo" type="email" placeholder="Ingresa tu correo electrónico" autocomplete="off" required>
        </div>
        <div class="flex items-center justify-center">
            <button class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
               Enviar Correo
            </button>
        </div>
    
    </form>
</body>
</html>