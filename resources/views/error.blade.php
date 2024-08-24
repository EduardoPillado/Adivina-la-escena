<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página no encontrada</title>
    <style>
        body {
        background-color: #e6e3e3;
        text-align: center;
        padding: 50px;
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }
        
        h1, h2 {
        font-size: 50px;
        text-shadow: 2px 2px #ccc;
        }

        .error-message {
        color: #333;
        text-shadow: 0 1px 0 #fff;
        margin: 20px 0;
        }

        @keyframes caer {
        0% { transform: translateY(-1200%); }
        100% { transform: translateY(1000%); }
        }

        body {
        overflow: hidden;
        perspective: 1000px;
        }

        .signo {
        position: absolute;
        font-size: 30px;
        animation: caer linear infinite;
        }

        .signo:before {
        content: "❔";
        }

        @keyframes colorChange {
        0% { color: rgb(255, 196, 0); }
        25% { color: rgb(47, 47, 47); }
        50% { color: rgb(255, 196, 0); }
        75% { color: rgb(47, 47, 47); }
        100% { color: rgb(255, 196, 0); }
        }

        a, h2 {
        animation-name: colorChange;
        animation-duration: 5s;
        animation-iteration-count: infinite;
        }
    </style>
</head>
<body>
    <h1>¿Ups?</h1>
    <h2>ERROR 404</h2>
    <div class="error-message">
        <p>Parece que esta escena no está en el guión, ha olvidado su papel y ha salido del escenario.</p>
        <p>Pero no te preocupes, siempre puedes volver al <a href="{{ route('inicio') }}">inicio</a> y seguir adivinando otras escenas. ¡Nos vemos en el <a href="{{ route('inicio') }}">escenario</a>!</p>
    </div>
    <script>
        const n = 200; // número de signos de interrogación
        for (let i = 0; i < n; i++) {
        const signo = document.createElement('div');
        signo.className = 'signo';
        signo.style.setProperty('--i', i);
        signo.style.setProperty('--n', n);
        signo.style.setProperty('animation-duration', `${3 + Math.random() * 3}s`);
        signo.style.setProperty('animation-delay', `${Math.random() * 2}s`);
        signo.style.setProperty('left', `${Math.random() * 100}%`);
        document.body.appendChild(signo);
        }
    </script>
</body>
</html>