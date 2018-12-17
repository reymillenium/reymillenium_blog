<?php

    include_once 'app/config.inc.php';
    include_once SESSION_CONTROL_URL;
    include_once REDIRECTION_URL;


    // Antes que nada verifico si el usuario ya inició una sesión
    if ((SessionControl::is_the_session_started()))
    { // Si la sesión no ha sido iniciada... 
        if ($reason == 'logout')
        {
            // Eliminamos la sesión
            SessionControl::close_session();

            // Redirigimos al usuario de nuevo a esta página, para refrescar la interfaz
            //Redirection::redirect($_SERVER['PHP_SELF']);
            //Redirection::redirect(USER_LOGIN_PAGE_URL);
            Redirection::redirect(SERVER_URL);
        }
        else
        { // No se quiere deslogear el usuario
            // Sacamos al usuario de esta página, redirigiéndolo hacia index.php
            Redirection::redirect(SERVER_URL);
        }
    }
    else
    { // No se inició la sesión
        // Sacamos al usuario de esta página, redirigiéndolo hacia index.php
        Redirection::redirect(SERVER_URL);
    }
       
    