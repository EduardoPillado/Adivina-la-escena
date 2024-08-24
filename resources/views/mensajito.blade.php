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
    <form class="frm-w bg-yellow-100 p-8 rounded-lg max-w-md mx-auto">
        <h1 class="text-2xl font-bold mb-4 text-center">Solicitud de Confirmación</h1>
        <p class="msg text-gray-800 text-center mb-4">Hemos enviado indicaciones a tu correo electrónico para poder proceder con el registro de tu cuenta.</p>
    </form>
</body>
</html>