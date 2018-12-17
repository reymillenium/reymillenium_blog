<?php

    include_once 'app/config.inc.php';
    include_once CONNECTION_URL;
    
    include_once PASSWORD_RECOVERY_CLASS_URL;

    class PasswordRecoveryRepository {

        // *** Inserción ***
        public static function insert_password_recovery($connection, $new_password_recovery) {

            // Declaro una variable booleana de confirmación de éxito al insertar el password_recovery
            $the_password_recovery_was_inserted = false;

            if (isset($connection))
            {
                try {

                    // Declaro el código SQL
                    $sql = "INSERT INTO " . DB_NAME . ".password_recoveries "
                            . "(password_recovery_author_id, password_recovery_secret_url, password_recovery_creation_date)"
                            . "VALUES (:password_recovery_author_id, :password_recovery_secret_url, NOW())";

                    # Escapa los caracteres, para evitar el peligro de la inyección. Lo hace seguro y a prueba de errores
                    $sentence = $connection -> prepare($sql);

                    // Volcamos los campos del pssword_recovery en variables, pues la ultima actualizacion de PHP no acepta sino variables en el bindParam
                    $password_recovery_author_id = $new_password_recovery -> get_password_recovery_author_id();
                    $password_recovery_secret_url = $new_password_recovery -> get_password_recovery_secret_url();

                    // Hacemos ahora el bindParam, usando solo variables
                    $sentence -> bindParam(':password_recovery_author_id', $password_recovery_author_id, PDO::PARAM_INT);
                    $sentence -> bindParam(':password_recovery_secret_url', $password_recovery_secret_url, PDO::PARAM_STR);

                    # Ejecuto la sentencia SQL ya preparada anteriormente
                    $the_password_recovery_was_inserted = $sentence -> execute();
                    #
                } catch (PDOException $exc) {

                    // echo $exc -> getTraceAsString();
                    print 'ERROR: ' . $exc -> getMessage() . "<br>";
                }
            }

            // Devolvemos la variable de confirmación, para saber si se tuvo éxito al insertar el password_recovery en la BD
            return $the_password_recovery_was_inserted;

        }

        // *** Borrado ***
        public static function delete_password_recovery_by_password_recovery_id($connection, $password_recovery_id) {

            // Declaro una variable booleana de confirmación de éxito al borrar el password_recovery 
            $the_password_recovery_was_deleted = false;

            if (isset($connection))
            {
                try {

                    #***************************************************************************************************
                    #                               Preparo la Operación                    
                    #***************************************************************************************************
                    #
                    // Declaro el código SQL # 1 para borrar el password_recovery
                    $sql_01 = "DELETE FROM " . DB_NAME . ".password_recoveries WHERE password_recovery_id = :password_recovery_id";

                    # Escapa los caracteres, para evitar el peligro de la inyección. Lo hace seguro y a prueba de errores
                    $sentence_01 = $connection -> prepare($sql_01);

                    // Hacemos ahora el bindParam, usando solo variables
                    $sentence_01 -> bindParam(':password_recovery_id', $password_recovery_id, PDO::PARAM_INT);

                    # Ejecuto la sentencia SQL # 1 ya preparada anteriormente
                    $the_password_recovery_was_deleted = $sentence_01 -> execute();
                    #
                } catch (PDOException $exc) {

                    // echo $exc -> getTraceAsString();
                    print 'ERROR: ' . $exc -> getMessage() . "<br>";
                }
            }

            // Devolvemos la variable de confirmación, para saber si se tuvo éxito al borrar el password_recovery en la BD
            return $the_password_recovery_was_deleted;

        }
        
        public static function delete_password_recovery_by_user_id($connection, $user_id) {

            // Declaro una variable booleana de confirmación de éxito al borrar el password_recovery 
            $the_password_recovery_was_deleted = false;

            if (isset($connection))
            {
                try {

                    #***************************************************************************************************
                    #                               Preparo la Operación                    
                    #***************************************************************************************************
                    #
                    // Declaro el código SQL para borrar el password_recovery
                    $sql_01 = "DELETE FROM " . DB_NAME . ".password_recoveries WHERE password_recovery_author_id = :user_id";

                    # Escapa los caracteres, para evitar el peligro de la inyección. Lo hace seguro y a prueba de errores
                    $sentence_01 = $connection -> prepare($sql_01);

                    // Hacemos ahora el bindParam, usando solo variables
                    $sentence_01 -> bindParam(':user_id', $user_id, PDO::PARAM_INT);

                    # Ejecuto la sentencia SQL ya preparada anteriormente
                    $the_password_recovery_was_deleted = $sentence_01 -> execute();
                    #
                } catch (PDOException $exc) {

                    // echo $exc -> getTraceAsString();
                    print 'ERROR: ' . $exc -> getMessage() . "<br>";
                }
            }

            // Devolvemos la variable de confirmación, para saber si se tuvo éxito al borrar el password_recovery en la BD
            return $the_password_recovery_was_deleted;

        }

        // *** Modificación ***
        public static function update_password_recovery($connection, $new_password_recovery) {

            // Declaro una variable booleana de confirmación de éxito al actualizar el password_recovery
            $the_password_recovery_was_updated = false;

            if (isset($connection))
            {
                try {

                    // Declaro el código SQL
                    $sql = "UPDATE " . DB_NAME . ".password_recoveries SET "
                            . "password_recovery_author_id = :password_recovery_author_id, "
                            . "password_recovery_secret_url = :password_recovery_secret_url, "
                            . "password_recovery_creation_date = NOW() WHERE password_recovery_id = :password_recovery_id";

                    # Escapa los caracteres, para evitar el peligro de la inyección. Lo hace seguro y a prueba de errores
                    $sentence = $connection -> prepare($sql);

                    // Volcamos los campos del password_recovery en variables, pues la ultima actualizacion de PHP no acepta sino variables en el bindParam
                    $password_recovery_id = $new_password_recovery -> get_password_recovery_id();
                    $password_recovery_author_id = $new_password_recovery -> get_password_recovery_author_id();
                    $password_recovery_secret_url = $new_password_recovery -> get_password_recovery_secret_url();

                    // Hacemos ahora el bindParam, usando solo variables
                    $sentence -> bindParam(':password_recovery_id', $password_recovery_id, PDO::PARAM_INT);
                    $sentence -> bindParam(':password_recovery_author_id', $password_recovery_author_id, PDO::PARAM_INT);
                    $sentence -> bindParam(':password_recovery_secret_url', $password_recovery_secret_url, PDO::PARAM_STR);

                    # Ejecuto la sentencia SQL ya preparada anteriormente
                    $the_password_recovery_was_updated = $sentence -> execute();
                    #
                } catch (PDOException $exc) {

                    // echo $exc -> getTraceAsString();
                    print 'ERROR: ' . $exc -> getMessage() . "<br>";
                }
            }

            // Devolvemos la variable de confirmación, para saber si se tuvo éxito al actualizar el password_recovery en la BD
            return $the_password_recovery_was_updated;

        }

        // *** Obtenciones ***
        public static function get_user_id_by_password_recovery_secret_url($connection, $password_recovery_secret_url) {

            $user_id = NULL;

            if (isset($connection))
            {
                try {
                    // Declaro el código SQL
                    $sql = "SELECT password_recovery_author_id FROM " . DB_NAME . ".password_recoveries WHERE password_recovery_secret_url = :password_recovery_secret_url";

                    # Escapa los caracteres, para evitar el peligro de la inyección. Lo hace seguro y a prueba de errores
                    $sentence = $connection -> prepare($sql);

                    // Hacemos ahora el bindParam, usando solo variables
                    $sentence -> bindParam(':password_recovery_secret_url', $password_recovery_secret_url, PDO::PARAM_STR);

                    # Ejecuto la sentencia SQL ya preparada anteriormente
                    $sentence -> execute();

                    # Guardo en el array $result el post (una sola entrada)
                    $result = $sentence -> fetch();

                    # Si hay al menos un post...
                    if (!empty($result))
                    { //  Si no está vacío...
                        // Recuperamos el password_recovery_author_id (user_id)
                        $user_id = $result['password_recovery_author_id'];
                    }

                    # Devuelvo el user_id
                    return $user_id;
                    #
                } catch (PDOException $ex) {

                    print 'ERROR: ' . $ex -> getMessage() . "<br>";
                }
            }

        }

        // *** Conteos ***
        #
        #
        #
        // *** Verificaciones de Existencia ***
        public static function password_recovery_exist_by_secret_url($connection, $password_recovery_secret_url) {

            // Declaro una variable booleana de confirmación de éxito al encontrar el password_recovery
            $the_password_recovery_exist = false;

            if (isset($connection))
            {
                try {
                    // Declaro el código SQL
                    $sql = "SELECT * FROM " . DB_NAME . ".password_recoveries WHERE password_recovery_secret_url = :password_recovery_secret_url";

                    # Escapa los caracteres, para evitar el peligro de la inyección. Lo hace seguro y a prueba de errores
                    $sentence = $connection -> prepare($sql);

                    // Hacemos ahora el bindParam, usando solo variables
                    $sentence -> bindParam(':password_recovery_secret_url', $password_recovery_secret_url, PDO::PARAM_STR);

                    # Ejecuto la sentencia SQL ya preparada anteriormente
                    $sentence -> execute();

                    # Guardo en el array $result todos los posts con la url especificado
                    $result = $sentence -> fetchAll();

                    if (count($result)) # Si hay al menos un password_recovery con ese url...
                    {
                        // Especifico en la variable de confirmación
                        $the_password_recovery_exist = true;
                    }
                    #
                } catch (PDOException $exc) {
                    // echo $exc -> getTraceAsString();
                    print 'ERROR: ' . $exc -> getMessage() . "<br>";
                }
            }

            // Devolvemos la variable de confirmación, para saber si se encontró el password_recovery en la base de datos
            return $the_password_recovery_exist;

        }
        
        public static function password_recovery_exist_by_user_id($connection, $user_id) {

            // Declaro una variable booleana de confirmación de éxito al encontrar el password_recovery
            $the_password_recovery_exist = false;

            if (isset($connection))
            {
                try {
                    // Declaro el código SQL
                    $sql = "SELECT * FROM " . DB_NAME . ".password_recoveries WHERE password_recovery_author_id = :user_id";

                    # Escapa los caracteres, para evitar el peligro de la inyección. Lo hace seguro y a prueba de errores
                    $sentence = $connection -> prepare($sql);

                    // Hacemos ahora el bindParam, usando solo variables
                    $sentence -> bindParam(':user_id', $user_id, PDO::PARAM_INT);

                    # Ejecuto la sentencia SQL ya preparada anteriormente
                    $sentence -> execute();

                    # Guardo en el array $result todos los posts con la url especificado
                    $result = $sentence -> fetchAll();

                    if (count($result)) # Si hay al menos un password_recovery con ese url...
                    {
                        // Especifico en la variable de confirmación
                        $the_password_recovery_exist = true;
                    }
                    #
                } catch (PDOException $exc) {
                    // echo $exc -> getTraceAsString();
                    print 'ERROR: ' . $exc -> getMessage() . "<br>";
                }
            }

            // Devolvemos la variable de confirmación, para saber si se encontró el password_recovery en la base de datos
            return $the_password_recovery_exist;

        }

    }
    