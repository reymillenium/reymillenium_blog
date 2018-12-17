<?php

    include_once("config.inc.php");

    class Connection {

        private static $connection;

        // Opens the connection to the DB
        public static function open_connection() {

            if (!isset(self::$connection)) # If is not initialized...
            {
                try {

                    // Hay dos tipos de drivers para trabajar con la base de datos:
                    // 
                    # mysqli (Solo sirve para MySQL. Es algo más rápido pero también es un poco más simple)
                    # 
                    # 
                    # PDO (Trabaja con unas 20 bases de datos diferentes. Es ligeramente más lento que con MySQL)
                    // Versión # 3: Por comprobar aun
                    $dsn = 'mysql:host=' . SERVER_NAME . ';DBName=' . DB_NAME;
                    self::$connection = new PDO($dsn, DB_USER_NAME, DB_USER_PASSWORD);

                    # Configuramos el modo de errores: Hacemos que por defecto PDO nos muestre los errores que haya con la base de datos
                    # Cada vez que ocurra un error, PDO lanzará una excepción y nos permitrá ver qué ha pasado exactamente
                    self::$connection -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    # Le decimos a la BD que use los caracteres utf8 (uno de los más universales y fáciles de leer)
                    self::$connection -> exec("SET CHARACTER SET utf8");

                    // print 'Conexión abierta' . '<br>';
                } catch (PDOException $ex) {

                    # Cambiamos de excepción normal a PDO Exemption
                    print 'ERROR: ' . $ex -> getMessage() . "<br>";

                    # Terminamos la conexión y cualquier intento de abrirla
                    die();
                }
            }

        }

        // Closes the connection to the DB
        public static function close_connection() {
            if (isset(self::$connection)) # If is initialized...
            {
                # Destruimos el objeto y liberamos la memoria
                self::$connection = NULL;
                // print 'Conexión cerrada' . '<br>';
            }

        }

        // Auxiliary public method to be able to use the Connection object outside of the class
        public static function get_connection() {
            return self::$connection;

        }

    }

?>

