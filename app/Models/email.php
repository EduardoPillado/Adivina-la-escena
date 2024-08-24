<?php 
     // Varios destinatarios
     $para  = $correo; //. ', '; // atención a la coma
     
     // título
     $titulo = 'POR FAVOR AYUDANOS A VERIFICAR TU E-MAIL';

     // mensaje
     $mensaje = '
    <html>
    <head>
    <meta charset="UTF-8">
    <title>VERIFICACION DE E-MAIL</title>
    </head>
    <body>
    <p>Haz click en el siguiente enlace para verificar tu email</p>
    <a href="' . route('verificar', ['token' => urlencode($token), 'correo' => urlencode($correo)]) . '">VERIFICAR</a>
    </body>
    </html>
';


     // Para enviar un correo HTML, debe establecerse la cabecera Content-type
     $headers  = 'MIME-Version: 1.0' . "\r\n";
     $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
     $headers .= 'From: Jeff Besos <amazon@pesos.com>' . "\r\n";

     // headers$headers adicionales
     // $headers .= 'To: Mary <mary@example.com>, Kelly <kelly@example.com>' . "\r\n";
     // $headers .= 'Cc: birthdayarchive@example.com' . "\r\n";
     // $headers .= 'Bcc: birthdaycheck@example.com' . "\r\n";

     // Enviarlo
     mail($para, $titulo, $mensaje, $headers);
?>
