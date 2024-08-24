<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="../css/estilo.css">
</head>
<body>
    
    <footer>
        <div class="footer-container">
            <div class="footer-column">
                <ul>
                    <li class="li-2"><a href="{{ route('inicio') }}"><img class="img-details" title="Inicio" src="{{ asset('img/paraInicio.png') }}" width="165px"></a></li>
                </ul>
            </div>
            <div class="footer-column">
                <div class="contact-container">
                    <a class="contact" href="{{ route('contact') }}">Contactanos</a>
                </div>
            </div>
        </div>
        <div class="rights-container">
            <p class="rights">© 2024 El Rosario, Sinaloa, México</p>
        </div>
    </footer>

</body>
</html>