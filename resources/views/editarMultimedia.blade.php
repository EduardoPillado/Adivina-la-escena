<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('img/LOGOTIPO.ico') }}" rel="icon">
    <title>Editar escena</title>
    <link rel="stylesheet" href="{{ asset('https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/estilo.css') }}">
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
        select {
            width: 95%;
            padding: 10px;
            margin-bottom: 20px;
            border: 2px solid #ccc;
            border-radius: 4px;
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
        <a href="{{ ('/escenitas') }}">
            <div title="Regresar" class="back-button">
                <i class="bi bi-arrow-90deg-left"></i>
            </div>
        </a>
    </div>

    <div class="flex flex-col sm:flex-row justify-center space-x-0 sm:space-x-10 mb-8">
        <form action="{{route('multimedia.actualizar', $datosMultimedia->pkMultimedia)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')

            <div>
                <center>
                    <label>Escena actual</label>
                    <td>
                        <video controls width="400">
                            <source src="{{ asset('storage/'.$datosMultimedia->nombreMultimedia) }}" type="video/mp4">
                        </video>
                    </td>
                </center>
            </div>

            <input type="file" id="multimediaFile" name="nombreMultimedia" accept="video/*" style="display: none;" onchange="loadFile(event)"><br>

            <label for="multimediaFile" name="nombreMultimedia" style="width: 95%; padding: 10px; margin-bottom: 20px; border: 2px solid #ccc; border-radius: 4px; cursor: pointer;">
                Haz clic para subir una escena nueva
            </label>

            <img id="output" width="200" />

            <label>Categoria de la escena:</label>
            <select name="fkCategoria" required>
            <option value="">Selecciona la categoría</option>
                @php
                    use App\Models\Categoria;
                    $datos_categoria=Categoria::all();
                @endphp
                @foreach ($datos_categoria as $dato)
                    <option @if ($dato->fkCategoria == $datosMultimedia->pkCategoria) selected @endif value="{{$dato->pkCategoria}}">{{$dato->nombreCategoria}}</option>
                @endforeach
            </select>

            @foreach($datosOpciones as $opcion)
                <label for="">Opción {{$loop->iteration}} @if($opcion->estatusOpcion == 1) (opción correcta) @else (opción) @endif</label>
                <input type="text" name="nombreOpcion{{$loop->iteration}}" value="{{$opcion->nombreOpcion}}" required>
                <input type="hidden" name="pkOpciones[]" value="{{$opcion->pkOpciones}}">
            @endforeach
            
            <center>
                <input type="submit" value="Guardar">
            </center>

        </form>
    </div>
    
    <script>
    var loadFile = function(event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
        }
    };
    </script>
    
</body>
</html>