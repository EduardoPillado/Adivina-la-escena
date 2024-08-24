<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('img/LOGOTIPO.ico') }}" rel="icon">
    <title>Categorías</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/estilo.css?=1">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Comic+Sans+MS&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css') }}">
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

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            transition: background-color 0.3s;
        }
    </style>
</head>
<body class="bg-cover pt-0 pb-0 bg-center bg-no-repeat font-comic-sans font-bold fondo-opaco-amarillo">

    @include('mensaje')

    <div class="flex flex-col sm:flex-row justify-center space-x-0 sm:space-x-10 mb-8">
    <a id="alertaAleatorio" href="{{ route('multimedia.aleatorio', ['modo' => 1]) }}">
            <div class="image-container">
                <img src="/img/Jack_Sparrow.gif">
                <div class="image-text">Película</div>
            </div>
        </a>

        <script>
                document.addEventListener('DOMContentLoaded', function() {
                  var link = document.getElementById('alertaPelicula');
            
                  link.addEventListener('click', function(event) {
                    event.preventDefault();
            
                    Swal.fire({
                      title: 'PREPARATE',
                      text: 'Adivina la película y escoge la respuesta correcta para ganar',
                      showConfirmButton: false,
                      timer: 3000
                    }).then((result) => {
                      window.location.href = link.getAttribute('href');
                    });
                  });
                });
        </script>

    <a id="alertaAleatorio" href="{{ route('multimedia.aleatorio', ['modo' => 2]) }}">
            <div class="image-container">
                <img src="/img/Jim.gif">
                <div class="image-text">Serie</div>
            </div>
        </a>

        <script>
                document.addEventListener('DOMContentLoaded', function() {
                  var link = document.getElementById('alertaSerie');
            
                  link.addEventListener('click', function(event) {
                    event.preventDefault();
            
                    Swal.fire({
                      title: 'PREPARATE',
                      text: 'Adivina la serie y escoge la respuesta correcta para ganar',
                      showConfirmButton: false,
                      timer: 3000
                    }).then((result) => {
                      window.location.href = link.getAttribute('href');
                    });
                  });
                });
        </script>

      <a id="alertaAleatorio" href="{{ route('multimedia.aleatorio', ['modo' => 3]) }}">
            <div class="image-container">
                <img src="/img/Joel_Ellie_&_a_Clicker.gif">
                <div class="image-text">Videojuego</div>
            </div>
        </a>

        <script>
                document.addEventListener('DOMContentLoaded', function() {
                  var link = document.getElementById('alertaVideojuego');
            
                  link.addEventListener('click', function(event) {
                    event.preventDefault();
            
                    Swal.fire({
                      title: 'PREPARATE',
                      text: 'Adivina el videojuego y escoge la respuesta correcta para ganar',
                      showConfirmButton: false,
                      timer: 3000
                    }).then((result) => {
                      window.location.href = link.getAttribute('href');
                    });
                  });
                });
        </script>
    </div>

    <div class="space"></div>

    <div class="flex flex-col sm:flex-row justify-center space-x-0 sm:space-x-10 mb-8">
        <a href="{{ route('inicio') }}">
            <div title="Regresar" class="back-button">
                <i class="bi bi-arrow-90deg-left"></i>
            </div>
        </a>
    </div>
    
</body>
</html>