<?php

    include_once 'app/config.inc.php';
    include_once CONNECTION_URL;
    
    include_once USER_CLASS_URL;

    class UserRepository {

        // Inserción
        public static function insert_user($connection, $new_user) {

            // Declaro una variable booleana de confirmación de éxito al insertar el usuario
            $the_user_was_inserted = false;

            if (isset($connection))
            {
                try {

                    // Declaro el código SQL
                    $sql = "INSERT INTO " . DB_NAME . ".users (user_firstname, user_secondname, user_lastname, user_email, user_password, user_phone, user_gender, user_is_active, user_kind, user_creation_date, user_image)"
                            . "VALUES (:user_firstname, :user_secondname, :user_lastname, :user_email, :user_password, :user_phone, :user_gender, 0, :user_kind, NOW(), :user_image)";

                    # Escapa los caracteres, para evitar el peligro de la inyección. Lo hace seguro y a prueba de errores
                    $sentence = $connection -> prepare($sql);

                    // Volcamos los campos del usuario en variables, pues la ultima actualizacion de PHP no acepta sino variables en el bindParam
                    $user_firstname = $new_user -> get_user_firstname();
                    $user_secondname = $new_user -> get_user_secondname();
                    $user_lastname = $new_user -> get_user_lastname();
                    $user_email = $new_user -> get_user_email();
                    $user_password = $new_user -> get_user_password();
                    $user_phone = $new_user -> get_user_phone();
                    $user_gender = $new_user -> get_user_gender();
                    $user_kind = $new_user -> get_user_kind();
                    $user_image = $new_user -> get_user_image();
                    #
                    // Hacemos ahora el bindParam, usando solo variables
                    $sentence -> bindParam(':user_firstname', $user_firstname, PDO::PARAM_STR);
                    $sentence -> bindParam(':user_secondname', $user_secondname, PDO::PARAM_STR);
                    $sentence -> bindParam(':user_lastname', $user_lastname, PDO::PARAM_STR);
                    $sentence -> bindParam(':user_email', $user_email, PDO::PARAM_STR);
                    $sentence -> bindParam(':user_password', $user_password, PDO::PARAM_STR);
                    $sentence -> bindParam(':user_phone', $user_phone, PDO::PARAM_INT);
                    $sentence -> bindParam(':user_gender', $user_gender, PDO::PARAM_STR);
                    $sentence -> bindParam(':user_kind', $user_kind, PDO::PARAM_STR);
                    $sentence -> bindParam(':user_image', $user_image, PDO::PARAM_STR);

                    # Ejecuto la sentencia SQL ya preparada anteriormente
                    $the_user_was_inserted = $sentence -> execute();
                    #
                } catch (PDOException $exc) {

                    // echo $exc -> getTraceAsString();
                    print 'ERROR: ' . $exc -> getMessage() . "<br>";
                }
            }

            // Devolvemos la variable de confirmación, para saber si se tuvo éxito al insertar el user en la BD
            return $the_user_was_inserted;

        }

        // Borrado
        public static function delete_user_and_its_posts_and_comments_by_user_id($connection, $user_id) {

            // Declaro unas variables booleanas de confirmación de éxito al borrar el User con sus Posts y Comments
            $the_comments_were_deleted = false;
            $the_posts_were_deleted = false;
            $the_user_was_deleted = false;

            if (isset($connection))
            {
                try {

                    // Inicio el registro de las transacciones a realizar en el Registro Secundario del Servidor
                    $connection -> beginTransaction();

                    #***************************************************************************************************
                    #                         Preparo la Operación # 1: Borrado de los Comentarios                    
                    #***************************************************************************************************
                    #
                    // Declaro el código SQL # 1 para borrar todos los Comments de todos los Posts del User
                    $sql_01_comments = "DELETE FROM " . DB_NAME . ".comments WHERE comment_author_id = :user_id";

                    # Escapa los caracteres, para evitar el peligro de la inyección. Lo hace seguro y a prueba de errores
                    $sentence_01_comments = $connection -> prepare($sql_01_comments);

                    // Hacemos ahora el bindParam, usando solo variables
                    $sentence_01_comments -> bindParam(':user_id', $user_id, PDO::PARAM_INT);

                    # Ejecuto la sentencia SQL # 1 ya preparada anteriormente
                    $the_comments_were_deleted = $sentence_01_comments -> execute();

                    #***************************************************************************************************
                    #                           Preparo la Operación # 2: Borrado de los Posts                    
                    #***************************************************************************************************
                    #
                    // Declaro el código SQL # 2 para borrar todos los Posts del User
                    $sql_02_posts = "DELETE FROM " . DB_NAME . ".posts WHERE post_author_id = :user_id";

                    # Escapa los caracteres, para evitar el peligro de la inyección. Lo hace seguro y a prueba de errores
                    $sentence_02_posts = $connection -> prepare($sql_02_posts);

                    // Hacemos ahora el bindParam, usando solo variables
                    $sentence_02_posts -> bindParam(':user_id', $user_id, PDO::PARAM_INT);

                    # Ejecuto la sentencia SQL # 2 ya preparada anteriormente
                    $the_posts_were_deleted = $sentence_02_posts -> execute();

                    #***************************************************************************************************
                    #                            Preparo la Operación # 2: Borrado del User                    
                    #***************************************************************************************************
                    #
                    // Declaro el código SQL # 3 para borrar el User
                    $sql_03_user = "DELETE FROM " . DB_NAME . ".users WHERE user_id = :user_id";

                    # Escapa los caracteres, para evitar el peligro de la inyección. Lo hace seguro y a prueba de errores
                    $sentence_03_user = $connection -> prepare($sql_03_user);

                    // Hacemos ahora el bindParam, usando solo variables
                    $sentence_03_user -> bindParam(':user_id', $user_id, PDO::PARAM_INT);

                    # Ejecuto la sentencia SQL # 3 ya preparada anteriormente
                    $the_user_was_deleted = $sentence_03_user -> execute();

                    #***************************************************************************************************
                    #
                    // Confirmamos las operaciones que hayamos echo
                    $connection -> commit();
                    #
                } catch (PDOException $exc) {

                    // echo $exc -> getTraceAsString();
                    print 'ERROR: ' . $exc -> getMessage() . "<br>";

                    // Deshago todas las operaciones realizadas, porque ocurrrió al menos un error
                    $connection -> rollBack();
                }
            }

            // Devolvemos la variable de confirmación, para saber si se tuvo éxito al borrar el User en la BD, con sus posibles Comments y Posts
            return (($the_comments_were_deleted == true) && ($the_posts_were_deleted == true) && ($the_user_was_deleted == true)) ? true : false;

        }

        // Modificación
        public static function update_user_password_by_id($connection, $user_id, $new_user_password) {

            // Declaro una variable booleana de confirmación de éxito al actualizar el user_password
            $the_user_password_was_updated = false;

            if (isset($connection))
            {
                try {

                    // Declaro el código SQL
                    $sql = "UPDATE " . DB_NAME . ".users SET user_password = :new_user_password WHERE user_id = :user_id";

                    # Escapa los caracteres, para evitar el peligro de la inyección. Lo hace seguro y a prueba de errores
                    $sentence = $connection -> prepare($sql);

                    // Hacemos ahora el bindParam, usando solo variables
                    $sentence -> bindParam(':new_user_password', $new_user_password, PDO::PARAM_STR);
                    $sentence -> bindParam(':user_id', $user_id, PDO::PARAM_INT);

                    # Ejecuto la sentencia SQL ya preparada anteriormente
                    $the_user_password_was_updated = $sentence -> execute();
                    #
                } catch (PDOException $exc) {

                    // echo $exc -> getTraceAsString();
                    print 'ERROR: ' . $exc -> getMessage() . "<br>";
                }
            }

            // Devolvemos la variable de confirmación, para saber si se tuvo éxito al actualizar el user_password en la BD
            return $the_user_password_was_updated;

        }

        // *** Obtenciones ***
        // Selecciona todos los usuarios en la tabla " . DB_NAME . ".users

        public static function get_all_the_users($connection) {

            $users = array();

            if (isset($connection))
            {
                try {

                    $sql = "SELECT * FROM " . DB_NAME . ".users";

                    # Escapa los caracteres, para evitar el peligro de la inyección. Lo hace seguro y a prueba de errores
                    $sentence = $connection -> prepare($sql);

                    # Ejecuto la sentencia SQL ya preparada anteriormente
                    $sentence -> execute();

                    # Guardo en el array $result todos los usuarios
                    $result = $sentence -> fetchAll();

                    if (count($result)) # Si hay al menos un usuario...
                    {
                        foreach ($result as $row) {
                            $users[] = new User(
                                    $row['user_id'], $row['user_firstname'], $row['user_secondname'], $row['user_lastname'], $row['user_email'], $row['user_password'],
                                    #
                                    $row['user_phone'], $row['user_gender'],
                                    #
                                    $row['user_is_active'], $row['user_kind'], $row['user_creation_date'], $row['user_image']
                            );
                        }

                        # Devuelvo el array de usuarios
                        return $users;
                    }
                    else
                    {
                        print 'No hay usuarios';
                    }
                } catch (PDOException $ex) {

                    print 'ERROR: ' . $ex -> getMessage() . "<br>";
                }
            }

        }

        public static function get_user_by_email($connection, $user_email) {

            $user = NULL;

            if (isset($connection))
            {
                try {
                    // Declaro el código SQL
                    $sql = "SELECT * FROM " . DB_NAME . ".users WHERE user_email = :user_email";

                    # Escapa los caracteres, para evitar el peligro de la inyección. Lo hace seguro y a prueba de errores
                    $sentence = $connection -> prepare($sql);

                    // Hacemos ahora el bindParam, usando solo variables
                    $sentence -> bindParam(':user_email', $user_email, PDO::PARAM_STR);

                    # Ejecuto la sentencia SQL ya preparada anteriormente
                    $sentence -> execute();

                    # Guardo en el array $result el usuario (una sola entrada)
                    $result = $sentence -> fetch();

//                    if (count($result)) # Si hay al menos un usuario...
                    if (!empty($result))
                    { //  Si no está vacío...
                        // Recuperamos cada campo del usuario
                        $user = new User(
                                $result['user_id'], $result['user_firstname'], $result['user_secondname'], $result['user_lastname'], $result['user_email'], $result['user_password'],
                                #
                                $result['user_phone'], $result['user_gender'],
                                #
                                $result['user_is_active'], $result['user_kind'], $result['user_creation_date'], $result['user_image']
                        );

                        # Devuelvo el usuario
                        return $user;
                    }
                } catch (PDOException $ex) {

                    print 'ERROR: ' . $ex -> getMessage() . "<br>";
                }
            }

        }

        public static function get_user_by_id($connection, $user_id) {

            $user = NULL;

            if (isset($connection))
            {
                try {
                    // Declaro el código SQL
                    $sql = "SELECT * FROM " . DB_NAME . ".users WHERE user_id = :user_id";

                    # Escapa los caracteres, para evitar el peligro de la inyección. Lo hace seguro y a prueba de errores
                    $sentence = $connection -> prepare($sql);

                    // Hacemos ahora el bindParam, usando solo variables
                    $sentence -> bindParam(':user_id', $user_id, PDO::PARAM_STR);

                    # Ejecuto la sentencia SQL ya preparada anteriormente
                    $sentence -> execute();

                    # Guardo en el array $result el usuario (una sola entrada)
                    $result = $sentence -> fetch();

//                    if (count($result)) # Si hay al menos un usuario...
                    if (!empty($result))
                    { //  Si no está vacío...
                        // Recuperamos cada campo del usuario
                        $user = new User(
                                $result['user_id'], $result['user_firstname'], $result['user_secondname'], $result['user_lastname'], $result['user_email'], $result['user_password'],
                                #
                                $result['user_phone'], $result['user_gender'],
                                #
                                $result['user_is_active'], $result['user_kind'], $result['user_creation_date'], $result['user_image']
                        );

                        # Devuelvo el usuario
                        return $user;
                    }
                } catch (PDOException $ex) {

                    print 'ERROR: ' . $ex -> getMessage() . "<br>";
                }
            }

        }

        // *** Conteos ***
        public static function count_all_the_users($connection) {


            $totalUsers = NULL;

            if (isset($connection))
            {
                try {

                    // Declaro el código SQL
                    $sql = "SELECT COUNT(*) AS totalUsers FROM " . DB_NAME . ".users";

                    # Escapa los caracteres, para evitar inyecciones SQL. Lo hace seguro y a prueba de errores
                    $sentence = $connection -> prepare($sql);

                    # Ejecuto la sentencia SQL ya preparada anteriormente
                    $sentence -> execute();

                    # Guardo en la variable $result la cantidad de usuarios
                    $result = $sentence -> fetch();

                    // $totalUsers = count($result);
                    $totalUsers = $result['totalUsers'];

                    return $totalUsers;
                } catch (PDOException $ex) {

                    print 'ERROR: ' . $ex -> getMessage() . "<br>";
                }
            }

        }

        // *** Verificaciones de Existencia ***
        public static function user_exist_by_email($connection, $user_email) {

            // Declaro una variable booleana de confirmación de éxito al encontrar el usuario
            $the_user_exist = false;

            if (isset($connection))
            {
                try {
                    // Declaro el código SQL
                    $sql = "SELECT * FROM " . DB_NAME . ".users WHERE user_email = :user_email";

                    # Escapa los caracteres, para evitar el peligro de la inyección. Lo hace seguro y a prueba de errores
                    $sentence = $connection -> prepare($sql);

                    // Hacemos ahora el bindParam, usando solo variables
                    $sentence -> bindParam(':user_email', $user_email, PDO::PARAM_STR);

                    # Ejecuto la sentencia SQL ya preparada anteriormente
                    $sentence -> execute();

                    # Guardo en el array $result todos los usuarios con el email especificado
                    $result = $sentence -> fetchAll();

                    if (count($result)) # Si hay al menos un usuario con ese email...
                    {
                        // Especifico en la variable de conformación
                        $the_user_exist = true;
                    }
                    #
                } catch (PDOException $exc) {
                    // echo $exc -> getTraceAsString();
                    print 'ERROR: ' . $exc -> getMessage() . "<br>";
                }
            }

            // Devolvemos la variable de confirmación, para saber si se encontró el usuario en la base de datos
            return $the_user_exist;

        }

        public static function user_exist_by_phone($connection, $user_phone) {

            // Declaro una variable booleana de confirmación de éxito al encontrar el usuario
            $the_user_exist = false;

            if (isset($connection))
            {
                try {
                    // Declaro el código SQL
                    $sql = "SELECT * FROM " . DB_NAME . ".users WHERE user_phone = :user_phone";

                    # Escapa los caracteres, para evitar el peligro de la inyección. Lo hace seguro y a prueba de errores
                    $sentence = $connection -> prepare($sql);

                    // Hacemos ahora el bindParam, usando solo variables
                    $sentence -> bindParam(':user_phone', $user_phone, PDO::PARAM_STR);

                    # Ejecuto la sentencia SQL ya preparada anteriormente
                    $sentence -> execute();

                    # Guardo en el array $result todos los usuarios con el phone especificado
                    $result = $sentence -> fetchAll();

                    if (count($result)) # Si hay al menos un usuario con ese phone...
                    {
                        // Especifico en la variable de conformación
                        $the_user_exist = true;
                    }
                    #
                } catch (PDOException $exc) {
                    // echo $exc -> getTraceAsString();
                    print 'ERROR: ' . $exc -> getMessage() . "<br>";
                }
            }

            // Devolvemos la variable de confirmación, para saber si se encontró el usuario en la base de datos
            return $the_user_exist;

        }

    }
    