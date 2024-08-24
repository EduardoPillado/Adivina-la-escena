<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('img/LOGOTIPO.ico') }}" rel="icon">
    <title>Contactanos</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="../css/estilo.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <style>
        .fondo-opaco-amarillo {
            background-image: linear-gradient(rgba(255, 255, 0, 0.5), rgba(255, 255, 0, 0.5)), url('/img/fondo.png');
            background-size: cover;
            background-position: center;
        }

        body {
            font-family: Arial, sans-serif;
            /* display: flex; */
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f6f6f6;
        }
    </style>
</head>
<body class="bg-cover pt-0 pb-0 bg-center bg-repeat font-comic-sans font-bold fondo-opaco-amarillo h-screen">
    
    @include('mensaje')
    @include('header')

    <div class="flex justify-center items-center">
        <form class="frm-w bg-yellow-100 p-8 rounded-lg max-w-md mx-auto" action="{{ route('usuario.contacto') }}" method="POST" onsubmit="return validateRecaptcha()">
            <div id="recaptcha-active-message" class="hidden" style="background-color: green; padding: 10px; border: none;">Recaptcha activo</div>
            <div id="recaptcha-inactive-message" class="hidden" style="background-color: red; padding: 10px; border: none;">Por favor, complete el reCAPTCHA</div>
            <div id="recaptcha-not-activated" class="block" style="background-color: red; padding: 10px; border: none;">Por favor, activa el reCAPTCHA</div>

            @csrf

            <h1 class="text-2xl font-bold mb-4 text-center">Ingresa tu Correo, Mensaje y Propósito</h1>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="correo">Correo</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="correo" name="correo" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="proposito">Propósito</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="proposito" name="proposito" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="mensaje">Mensaje</label>
                <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="mensaje" name="mensaje" rows="4" required></textarea>
            </div>

            <div class="flex items-start mb-5">
                <div class="g-recaptcha" data-sitekey="6LdnGbcpAAAAAOkMwPwCa8eAEnP0VsuejLlI_7Kv" data-callback="showRecaptchaMessage"></div>
            </div>

            <div class="flex items-center justify-center">
                <button id="submitButton" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit" disabled>Enviar Correo</button>
            </div>
        </form>
    </div>

    @include('footer')

</body>

<script>
    function showRecaptchaMessage() {
        document.getElementById('recaptcha-active-message').classList.remove('hidden');
        document.getElementById('recaptcha-inactive-message').classList.add('hidden');
        document.getElementById('recaptcha-not-activated').classList.add('hidden');
        document.getElementById('submitButton').disabled = false;
    }

    function validateRecaptcha() {
        var recaptchaResponse = grecaptcha.getResponse();
        if (recaptchaResponse.length === 0) {
            document.getElementById('recaptcha-active-message').classList.add('hidden');
            document.getElementById('recaptcha-inactive-message').classList.remove('hidden');
            document.getElementById('recaptcha-not-activated').classList.add('hidden');
            return false;
        } else if (document.getElementById('recaptcha-not-activated').classList.contains('block')) {
            document.getElementById('recaptcha-not-activated').classList.remove('block');
            document.getElementById('recaptcha-not-activated').classList.add('hidden');
            return false;
        }
        return true;
    }
</script>

</html>