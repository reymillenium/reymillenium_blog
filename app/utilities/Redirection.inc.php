<?php

    class Redirection {

        public static function redirect($url) {
            // Error 404 = not found (una pagina web no disponible)
            // 502 = Error interno del servidor. Nuestra página no funciona
            // 301 = Redirección. Por si nos visita un bot de Google, Bing, etc y sepa lo que está pasando gracias a es código
            header('Location:' . $url, true, 301);

            // Hará que la ejecución termine allí. Impide que los bot exploren todas las rutas x get de nuestro sitio web (links)
            exit();
            // die(); // Hace lo mismo que exit()

        }

    }
    