<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- Iconos --}}
    <link rel="stylesheet" href="{{ asset('https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css') }}">
    <script src="https://kit.fontawesome.com/69e6d6a4a5.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    {{-- CSS --}}
    <link rel="stylesheet" href="../css/estilo.css?=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    {{-- SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- Tailwind --}}
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>

    @include('mensaje')

    @php
        $PKUSUARIO = session('pkUsuario');

        session_start();
        if (!isset($_SESSION[$PKUSUARIO])){
            header("location: login.blade.php");
        }

        $Usuario = session('nombreUsuario');
        $tipoUsuario = session('tipoUsuario');
    @endphp

    <nav>
        <ul>
            <li class="li-1">
                <a id="alertaCategorias" href="{{ route('categoria.seleccion') }}" id="offcanvasNavbarDropdown" role="button" aria-expanded="false">
                    Categorías
                </a>

                <script>
                    document.getElementById('alertaCategorias').addEventListener('click', function(event) {
                        var loggedIn = {{ session('pkUsuario') ? 'true' : 'false' }};
                        if (!loggedIn) {
                            event.preventDefault(); 
                            Swal.fire({
                                icon: 'warning',
                                text: 'Debes iniciar sesión',
                                showConfirmButton: false,
                                timer: 2000
                            });
                            return;
                        }
                    });
                </script>
            </li>

            <li class="li-1"><a href="{{ route('inicio') }}"><img class="img-details" title="Inicio" src="{{ asset('img/paraInicio.png') }}" width="165px"></a></li>

            @if ($PKUSUARIO)
                <li class="li-1 dropdown icon-margin">
                    <a href="#" id="offcanvasNavbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-circle icons-header"></i>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="offcanvasNavbarDropdown">
                        <li>
                            @if($tipoUsuario == 1)
                                <a id="enlaceAdministrador" class="dropdown-item" href="{{ route('administrador') }}" role="button">
                                    {{ $Usuario }} 
                                </a>
                            @elseif ($tipoUsuario == 2)
                                <a id="enlaceAdministrador" class="dropdown-item" href="{{ route('profile') }}" role="button">
                                    {{ $Usuario }} 
                                </a>
                            @endif
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item" href="{{ route('cerrarSesion') }}" role="button">
                                Cerrar sesión
                            </a>
                        </li>
                    </ul>
                </li>
            @else
                <li class="li-1 nav-item">
                    <a class="navbar-brand" href="{{ route('login') }}" role="button">
                        Iniciar sesión
                    </a>
                </li>
            @endif
        </ul>
    </nav>

{{-- 
    <div class="flex justify-center pt-5 sm:pt-10">
        <div class="bg-yellow-100 p bg-gray-100 rounded-lg p-4 sm:p-6 w-full sm:w-2/4 flex flex-col sm:flex-row justify-between items-center mb-4">
            <div class="bg-yellow-500 text-white font-bold px-4 py-2 rounded-lg mb-4 sm:mb-0">Regístrate</div>
            <div class="bg-white"><img src="/img/paraInicio.png" alt="Ejemplo" class="w-32 sm:w-40 h-12 sm:h-16"></div>
            <div class="bg-yellow-500 text-white font-bold px-4 py-2 rounded-lg">Inicia sesión</div>
        </div>
    </div> --}}
    
</body>
</html>