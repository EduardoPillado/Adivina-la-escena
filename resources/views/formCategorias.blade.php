<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('img/LOGOTIPO.ico') }}" rel="icon">
    <title>Agregar categoría</title>
    <link rel="stylesheet" href="{{ asset('https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="../css/estilo.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Comic+Sans+MS&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            /* display: flex; */
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f6f6f6;
        }
        form {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
        }
        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        input[type="text"] {
            width: 95%;
            padding: 10px;
            margin-bottom: 20px;
            border: 2px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #FACC2E;
            color: #fff;
            font-weight: bold;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
        }
        input[type="submit"]:hover {
            background-color: #FACC2E;
        }
        a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px;
            text-decoration: none;
            color: #FACC2E;
            transition: color 0.3s ease-in-out;
        }
        a:hover {
            color: #FACC2E;
        }

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

    {{-- @include('header') --}}
    @include('mensaje')

    <div class="zone3"></div>

    <div class="flex flex-col sm:flex-row justify-center space-x-0 sm:space-x-10 mb-8">
        <a href="{{ route('administrador') }}">
            <div title="Regresar" class="back-button">
                <i class="bi bi-arrow-90deg-left"></i>
            </div>
        </a>
    </div>

    <div class="flex flex-col sm:flex-row justify-center space-x-0 sm:space-x-10 mb-8">
        <form action="{{route('categoria.insertar')}}" method="post">
            @csrf

            <label>Nombre de la categoria:</label><br>

            <input type="text" name="nombreCategoria" required><br>

            <input type="submit" value="Guardar">
            
        </form>
    </div>

</body>
</html>