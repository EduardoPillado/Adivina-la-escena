<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('img/LOGOTIPO.ico') }}" rel="icon">
    <title>Editar usuario</title>
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
        input[type="text"], input[type="password"], input[type="email"] {
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

@php
  $result = DB::select('CALL usuario_crud(?, ?, ?, ?, ?, ?, ?, ?)', ['mostrarTipousuario', null, null, null, null, null, null, null]);
@endphp

<body class="fondo-opaco-amarillo">

  @include('mensaje')

  <div class="flex flex-col sm:flex-row justify-center space-x-0 sm:space-x-10 mb-8">
    <a href="{{ ('/allUsers') }}">
      <div title="Regresar" class="back-button">
        <i class="bi bi-arrow-90deg-left"></i>
      </div>
    </a>
  </div>

  <div class="flex flex-col sm:flex-row justify-center space-x-0 sm:space-x-10 mb-8">
    <form id="formulario" action="{{ route('usuario.actualizar', $dato[0]->token) }}" enctype="multipart/form-data"  method="post">
      @csrf

      <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2" for="usuario">
          Usuario
        </label>
        <input
          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
          name="nombreUsuario"
          id="usuario"
          type="text"
          placeholder="Ingresa tu usuario"
          value="{{$dato[0]->nombreUsuario}}"
          required/>
      </div>
      <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2" for="correo">
          Correo
        </label>
        <input
          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
          id="correo"
          name="correo"
          type="email"
          value="{{$dato[0]->correo}}"
          placeholder="Ingresa tu correo electrónico"
          required
        />
      </div>
      <div class="mb-6">
        <label class="block text-gray-700 font-bold mb-2" for="contrasena">
          Contraseña
        </label>
        <input
          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
          name="contraseña"
          id="contrasena"
          type="password"
          placeholder="Ingresa tu contraseña"
          required/>
      </div>
      <select name="fkTipoUsuario" id="" required>
      <option value="">Selecciona una opción</option>

      @foreach ($result as $row)
          <option value="{{ $row->pkTipoUsuario }}" 
              @if ($row->pkTipoUsuario === $dato[0]->fkTipoUsuario ) selected @endif>
              {{ $row->nombreTipoUsuario }}
          </option>
      @endforeach
    </select>



      <center>
        <input type="submit" value="Guardar">
      </center>
    </form>
  </div>

</body>
</html>