<?php

    // Le indicará al cliente cuando cargue que la página no se ha encontrado
    header($_SERVER['SERVER_PROTOCOL'] . "404 Not Found", true, 404);
    
    // Mostramos...
    echo 'La página no existe';
    