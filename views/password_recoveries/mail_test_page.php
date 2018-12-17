<?php

    $receiver = 'bexulitag@send22u.info';
    $subject = 'Prueba de email';
    $message = 'Esto es una prueba de cómo se envía un email usando PHP';


    $the_email_was_sended = mail($receiver, $subject, $message);

    if ($the_email_was_sended)
    {

        echo 'Email enviado';
    }
    else
    {
        echo 'Envío fallido';
    }
    
    
    