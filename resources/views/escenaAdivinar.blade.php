<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('img/LOGOTIPO.ico') }}" rel="icon">
    <title>Escena</title>
    <link rel="stylesheet" href="../css/estilo.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Comic+Sans+MS&display=swap" rel="stylesheet">
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
<body class="fondo-opaco-amarillo">

    @include('mensaje')

    @php
        $contadorNiveles = session()->get('contador_niveles', 0) + 1;
        session()->put('contador_niveles', $contadorNiveles);
    @endphp

    <div class="escena-container">
        <video id="escena" class="escena" autoplay>
            <source src="{{ asset('storage/'.$multimedia->nombreMultimedia) }}">
        </video>

        <div id="progressBar">
            <div id="progress"></div>
            <center style="font-size: 20px">{{ $contadorNiveles }}</center>
        </div>
    </div>

    <form id="opcionesForm" method="post" action="{{ route('opciones-escena') }}">
        @csrf
        <input type="hidden" name="fkMultimedia" value="{{ $multimedia->pkMultimedia }}">
    </form>
    
    <script>
        var video = document.getElementById("escena");
        var progressBar = document.getElementById("progress");

        video.addEventListener("timeupdate", function() {
            var value = (100 / video.duration) * video.currentTime;
            progressBar.style.width = value + "%";
        });

        video.addEventListener("ended", function() {
            document.getElementById("opcionesForm").submit();
        });
    </script>
    
</body>
</html>