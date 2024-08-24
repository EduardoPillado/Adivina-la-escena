<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('img/LOGOTIPO.ico') }}" rel="icon">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Juego</title>
    <style>
        :root {
            --box_color: #f59e0b;
        }

        .fondo-opaco-amarillo {
            background-image: linear-gradient(rgba(255, 255, 0, 0.5), rgba(255, 255, 0, 0.5)), url('/img/fondo.png');
            background-size: cover;
            background-position: center;
        }
        
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        h1 {
            position: absolute;
            top: 10;
        }
        h2{
            position: absolute;
            top: 0;
            left: 0;
        }
        .container {
            width: 400px;
            height: 400px;
            position: relative;
        }
        .box {
            width: 180px;
            height: 180px;
            position: absolute;
            border-radius: 15px;
            transition: background-color 0.3s ease;
        }
        .box:hover {
            background-color: #ddd;
        }
        .box1 {
            background-color: var(--box_color);
            top: 10px;
            left: 10px;
            border: none;
        }
        .box2 {
            background-color: var(--box_color);
            top: 10px;
            right: 10px;
            border: none;
        }
        .box3 {
            background-color: var(--box_color);
            bottom: 10px;
            left: 10px;
            border: none;
        }
        .box4 {
            background-color: var(--box_color);
            bottom: 10px;
            right: 10px;
            border: none;
        }
    </style>
</head>
<body class="fondo-opaco-amarillo">
@include('mensaje')
    <h1 id="countdown">10</h1>
    
    <br>
    <br>
    <br>
    <br>
    
    <?php
if ($opciones->count() > 0) {
    echo "<div class='container'>";
    echo "<form method='post' action='" . route('verificarRespuesta') . "'>";
    echo csrf_field();

    $count = 1;
    foreach ($opciones as $opcion) {

        echo "<button class='box box" . $count . "' name='opcion_elegida_" . $count . "' value='" . $opcion->estatusOpcion . "'>" . $opcion->nombreOpcion . "</button>";
        $count++;
        if ($count > 4) {
            break;
        }
    }

    echo "</form>";
    echo "</div>";
} else {
    echo "0 resultados";
}
?>
    <script>
    var countdown = document.getElementById("countdown");
    var seconds = 10;
    
    var interval = setInterval(function() {
        seconds--;
        countdown.innerText = seconds;
    
        if (seconds <= 0) {
            clearInterval(interval);
            Swal.fire({
                title: 'SE ACABO EL TIEMPO',
                text: 'No lograste elegir una respuesta a tiempo, se acabó el juego',
                showConfirmButton: false,
                timer: 3000
            }).then((result) => {
                window.location.href = "/";
            });
        }
    }, 1000);
    </script>
    
</body>
</html>