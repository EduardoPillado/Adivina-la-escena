<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="{{ asset('img/LOGOTIPO.ico') }}" rel="icon">
  <title>Adivina la Escena</title>
  <style>
    .fondo-opaco-amarillo {
      background-image: linear-gradient(rgba(255, 255, 0, 0.5), rgba(255, 255, 0, 0.5)), url('/img/fondo.png');
      background-size: cover;
      background-position: center;
    }
  </style>
</head>
<body class="bg-cover pt-0 pb-0 bg-center bg-no-repeat font-comic-sans font-bold fondo-opaco-amarillo">

  @include('mensaje')
  @include('header')

  {{-- <div class="flex justify-center pt-5 sm:pt-10">
    <div class="bg-yellow-100 p bg-gray-100 rounded-lg p-4 sm:p-6 w-full sm:w-2/4 flex flex-col sm:flex-row justify-between items-center mb-4">
      <a href="/aggUser" class="bg-yellow-500 text-white font-bold px-4 py-2 rounded-lg mb-4 sm:mb-0">Regístrate</a>
      <div class="bg-white"><img src="/img/paraInicio.png" alt="Ejemplo" class="w-32 sm:w-40 h-12 sm:h-16"></div>
      <a href="/" class="bg-yellow-500 text-white font-bold px-4 py-2 rounded-lg">Inicia sesión</a>
    </div>
  </div> --}}

  <div class="flex justify-center">
    <div class="bg-yellow-100 p-4 sm:p-6 rounded-lg mb-8 mx-4 sm:mx-auto max-w-xl">
      <p class="text-gray-800 text-center text-sm sm:text-base">¡Bienvenido a Adivina la Escena, el juego más emocionante y divertido para los amantes del cine y los videojuegos! Prepárate para poner a prueba tus habilidades cinéfilas y demostrar tu conocimiento identificando escenas de tus películas, series y videojuegos favoritos.</p>
      <p class="text-gray-800 text-center mt-4 text-sm sm:text-base">Sumérgete en un mundo lleno de emoción y diversión mientras te desafiamos a reconocer qué escena pertenece a qué título. ¿Eres un experto en videojuegos? ¿Un cinéfilo apasionado? ¿O tal vez un fanático de las series de televisión? ¡Este es el lugar perfecto para demostrarlo!</p>
      <p class="text-gray-800 text-center mt-4 text-sm sm:text-base">¿Estás listo para demostrar tus habilidades y convertirte en el maestro de la pantalla grande y del mundo virtual? ¡Únete a nosotros y que comience la diversión en Adivina la Escena!</p>
    </div>
  </div>

  <div class="space"></div>

  <div class="flex flex-col sm:flex-row justify-center space-x-0 sm:space-x-10 mb-8">
    <div id="modo-container" class="bg-yellow-500 text-white font-bold rounded-lg py-8 px-4 sm:px-12 flex items-center justify-center w-full sm:w-60 h-48 sm:h-60 mb-8 sm:mb-0">
      <a id="alertaDemo" href="{{ route('multimedia.demo') }}">
        <div class="flex flex-col justify-center items-center">
          <img src="/img/demo.gif" alt="Ejemplo" class="w-72 sm:w-96 h-24 sm:h-32">
          <span class="mt-2">Demo</span>
        </div>
      </a>

      <script>
        document.addEventListener('DOMContentLoaded', function() {
          var link = document.getElementById('alertaDemo');
    
          link.addEventListener('click', function(event) {
            event.preventDefault();
    
            Swal.fire({
              title: 'PREPARATE PARA LA PRUEBA',
              text: 'Adivina la escena y escoge la respuesta correcta para ganar',
              showConfirmButton: false,
              timer: 3000
            }).then((result) => {
              window.location.href = link.getAttribute('href');
            });
          });
        });
      </script>
    </div>
    <div id="modo-container" class="bg-white text-gray-800 rounded-lg py-8 px-4 sm:px-12 flex items-center justify-center w-full sm:w-60 h-48 sm:h-60 mb-8 sm:mb-0">
    <a id="alertaAleatorio" href="{{ route('multimedia.aleatorio', ['modo' => 4]) }}">

        <div class="flex flex-col justify-center items-center">
          <img src="/img/random.gif" alt="Ejemplo" class="w-72 sm:w-96 h-24 sm:h-32">
          <span class="mt-2">Aleatorio</span>
        </div>
      </a>

      <script>
        document.addEventListener('DOMContentLoaded', function() {
          var link = document.getElementById('alertaAleatorio');

          link.addEventListener('click', function(event) {
            event.preventDefault();

            var loggedIn = {{ session('pkUsuario') ? 'true' : 'false' }};
            if (!loggedIn) {
              Swal.fire({
                icon: 'warning',
                text: 'Debes iniciar sesión',
                showConfirmButton: false,
                timer: 2000
              });
              return;
            }

            Swal.fire({
              title: 'PREPARATE',
              text: 'Adivina la escena aleatoria y escoge la respuesta correcta para ganar',
              showConfirmButton: false,
              timer: 3000
            }).then((result) => {
              window.location.href = link.getAttribute('href');
            });
          });
        });
      </script>
    </div>
    <div id="modo-container" class="bg-yellow-500 text-white font-bold rounded-lg py-8 px-4 sm:px-12 flex items-center justify-center w-full sm:w-60 h-48 sm:h-60">
      <a id="alertaPorCategoria" href="{{ route('categoria.seleccion') }}">
        <div class="flex flex-col justify-center items-center">
          <img src="/img/categoria.gif" alt="Ejemplo" class="w-72 sm:w-96 h-24 sm:h-32">
          <span class="mt-2">Por categoría</span>
        </div>
      </a>

      <script>
        document.addEventListener('DOMContentLoaded', function() {
          var link = document.getElementById('alertaPorCategoria');
    
          link.addEventListener('click', function(event) {
            event.preventDefault();

            var loggedIn = {{ session('pkUsuario') ? 'true' : 'false' }};
            if (!loggedIn) {
              Swal.fire({
                icon: 'warning',
                text: 'Debes iniciar sesión',
                showConfirmButton: false,
                timer: 2000
              });
              return;
            }
    
            Swal.fire({
              title: 'ESCOGE LA CATEGORÍA',
              text: 'Escoge tu categoría favorita y comienza a jugar',
              showConfirmButton: false,
              timer: 3000
            }).then((result) => {
              window.location.href = link.getAttribute('href');
            });
          });
        });
      </script>
    </div>
  </div>

  <div class="space"></div>

  <div id="categorias" class="flex flex-col sm:flex-row justify-center space-x-0 sm:space-x-10 mb-8">
    <div id="modo-container" class="bg-yellow-500 text-white font-bold rounded-lg py-8 px-4 sm:px-12 flex items-center justify-center w-full sm:w-60 h-48 sm:h-60 mb-8 sm:mb-0">
    <a id="alertaAleatorio" href="{{ route('multimedia.aleatorio', ['modo' => 1]) }}">

        <div class="flex flex-col justify-center items-center">
          <img src="/img/pelicula.gif" alt="Ejemplo" class="w-72 sm:w-96 h-24 sm:h-32">
          <span class="mt-2">Adivina la película</span>
        </div>
      </a>

      <script>
        document.addEventListener('DOMContentLoaded', function() {
          var link = document.getElementById('alertaPelicula');
    
          link.addEventListener('click', function(event) {
            event.preventDefault();

            var loggedIn = {{ session('pkUsuario') ? 'true' : 'false' }};
            if (!loggedIn) {
              Swal.fire({
                icon: 'warning',
                text: 'Debes iniciar sesión',
                showConfirmButton: false,
                timer: 2000
              });
              return;
            }
    
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
    </div>
    <div id="modo-container" class="bg-white text-gray-800 rounded-lg py-8 px-4 sm:px-12 flex items-center justify-center w-full sm:w-60 h-48 sm:h-60 mb-8 sm:mb-0">
    <a id="alertaAleatorio" href="{{ route('multimedia.aleatorio', ['modo' => 2]) }}">

        <div class="flex flex-col justify-center items-center">
          <img src="/img/series.gif" alt="Ejemplo" class="w-72 sm:w-96 h-24 sm:h-32">
          <span class="mt-2">Adivina la serie</span>
        </div>
      </a>

      <script>
        document.addEventListener('DOMContentLoaded', function() {
          var link = document.getElementById('alertaSerie');
    
          link.addEventListener('click', function(event) {
            event.preventDefault();

            var loggedIn = {{ session('pkUsuario') ? 'true' : 'false' }};
            if (!loggedIn) {
              Swal.fire({
                icon: 'warning',
                text: 'Debes iniciar sesión',
                showConfirmButton: false,
                timer: 2000
              });
              return;
            }
    
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
    </div>
    <div id="modo-container" class="bg-yellow-500 text-white font-bold rounded-lg py-8 px-4 sm:px-12 flex items-center justify-center w-full sm:w-60 h-48 sm:h-60">
    <a id="alertaAleatorio" href="{{ route('multimedia.aleatorio', ['modo' => 3]) }}">

        <div class="flex flex-col justify-center text-center items-center">
          <img src="/img/game.gif" alt="Ejemplo" class="w-72 sm:w-96 h-24 sm:h-32">
          <span class="mt-2">Adivina el videojuego</span>
        </div>
      </a>

      <script>
        document.addEventListener('DOMContentLoaded', function() {
          var link = document.getElementById('alertaVideojuego');
    
          link.addEventListener('click', function(event) {
            event.preventDefault();

            var loggedIn = {{ session('pkUsuario') ? 'true' : 'false' }};
            if (!loggedIn) {
              Swal.fire({
                icon: 'warning',
                text: 'Debes iniciar sesión',
                showConfirmButton: false,
                timer: 2000
              });
              return;
            }
    
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
  </div>

  <div class="space"></div>

  @include('footer')

</body>
</html>