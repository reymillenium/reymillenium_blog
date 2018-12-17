<?php

    include_once 'app/config.inc.php';
    include_once CONNECTION_URL;

    include_once POST_CLASS_URL;

    class PostRepository {

        // *** Inserción ***

        public static function insert_post($connection, $new_post) {

            // Declaro una variable booleana de confirmación de éxito al insertar el post
            $the_post_was_inserted = false;

            if (isset($connection))
            {
                try {
                    $arr = array(7, 8);
                    // Declaro el código SQL
                    $sql = "INSERT INTO " . DB_NAME . ".posts (post_author_id, post_title, post_url, post_text, post_is_active, post_creation_date)"
                            . "VALUES (:post_author_id, :post_title, :post_url, :post_text, :post_is_active, NOW())";

                    # Escapa los caracteres, para evitar el peligro de la inyección. Lo hace seguro y a prueba de errores
                    $sentence = $connection -> prepare($sql);

                    // Volcamos los campos del usuario en variables, pues la ultima actualizacion de PHP no acepta sino variables en el bindParam
                    $post_author_id = $new_post -> get_post_author_id();
                    $post_title = $new_post -> get_post_title();
                    $post_url = $new_post -> get_post_url();
                    $post_text = $new_post -> get_post_text();
                    $post_is_active = $new_post -> get_post_is_active();
                    // $post_creation_date = $new_post -> get_post_creation_date();
                    #
                    // Hacemos ahora el bindParam, usando solo variables
                    $sentence -> bindParam(':post_author_id', $post_author_id, PDO::PARAM_STR);
                    $sentence -> bindParam(':post_title', $post_title, PDO::PARAM_STR);
                    $sentence -> bindParam(':post_url', $post_url, PDO::PARAM_STR);
                    $sentence -> bindParam(':post_text', $post_text, PDO::PARAM_STR);
                    $sentence -> bindParam(':post_is_active', $post_is_active, PDO::PARAM_STR);

                    # Ejecuto la sentencia SQL ya preparada anteriormente
                    $the_post_was_inserted = $sentence -> execute();
                    #
                } catch (PDOException $exc) {

                    // echo $exc -> getTraceAsString();
                    print 'ERROR: ' . $exc -> getMessage() . "<br>";
                }
            }

            // Devolvemos la variable de confirmación, para saber si se tuvo éxito al insertar el post en la BD
            return $the_post_was_inserted;

        }

        // *** Borrado ***
        public static function delete_post_and_its_comments_by_post_id($connection, $post_id) {

            // Declaro unas variables booleanas de confirmación de éxito al borrar el Post con sus Comments
            $the_comments_were_deleted = false;
            $the_post_was_deleted = false;

            if (isset($connection))
            {
                try {

                    // Inicio el registro de las transacciones a realizar en el Registro Secundario del Servidor
                    $connection -> beginTransaction();

                    #***************************************************************************************************
                    #                               Preparo la Operación # 1                    
                    #***************************************************************************************************
                    #
                    // Declaro el código SQL # 1 para borrar los Comments
                    $sql_01 = "DELETE FROM " . DB_NAME . ".comments WHERE comment_post_id = :post_id";

                    # Escapa los caracteres, para evitar el peligro de la inyección. Lo hace seguro y a prueba de errores
                    $sentence_01 = $connection -> prepare($sql_01);

                    // Hacemos ahora el bindParam, usando solo variables
                    $sentence_01 -> bindParam(':post_id', $post_id, PDO::PARAM_INT);

                    # Ejecuto la sentencia SQL # 1 ya preparada anteriormente
                    $the_comments_were_deleted = $sentence_01 -> execute();

                    #***************************************************************************************************
                    #                              Preparo la Operación # 2                    
                    #***************************************************************************************************
                    #
                    // Declaro el código SQL # 2 para borrar el Post
                    $sql_02 = "DELETE FROM " . DB_NAME . ".posts WHERE post_id = :post_id";

                    # Escapa los caracteres, para evitar el peligro de la inyección. Lo hace seguro y a prueba de errores
                    $sentence_02 = $connection -> prepare($sql_02);

                    // Hacemos ahora el bindParam, usando solo variables
                    $sentence_02 -> bindParam(':post_id', $post_id, PDO::PARAM_INT);

                    # Ejecuto la sentencia SQL # 2 ya preparada anteriormente
                    $the_post_was_deleted = $sentence_02 -> execute();

                    // Confirmamos las operaciones que hayamos echo
                    $connection -> commit();
                    #
                } catch (PDOException $exc) {

                    // echo $exc -> getTraceAsString();
                    print 'ERROR: ' . $exc -> getMessage() . "<br>";

                    // Deshago las operaciones realizadas, porque ocurrrió un error
                    $connection -> rollBack();
                }
            }

            // Devolvemos la variable de confirmación, para saber si se tuvo éxito al borrar el Post en la BD

            return (($the_comments_were_deleted == true) && ($the_post_was_deleted == true)) ? true : false;

        }

        // *** Modificación ***
        public static function update_post($connection, $new_post) {

            // Declaro una variable booleana de confirmación de éxito al actualizar el Post
            $the_post_was_updated = false;

            if (isset($connection))
            {
                try {

                    // Declaro el código SQL
                    $sql = "UPDATE " . DB_NAME . ".posts SET post_author_id = :post_author_id, post_title = :post_title, "
                            . "post_url = :post_url, post_text = :post_text, post_is_active = :post_is_active, "
                            . "post_creation_date = NOW() WHERE post_id = :post_id";

                    # Escapa los caracteres, para evitar el peligro de la inyección. Lo hace seguro y a prueba de errores
                    $sentence = $connection -> prepare($sql);

                    // Volcamos los campos del Post en variables, pues la ultima actualizacion de PHP no acepta sino variables en el bindParam
                    $post_id = $new_post -> get_post_id();
                    $post_author_id = $new_post -> get_post_author_id();
                    $post_title = $new_post -> get_post_title();
                    $post_url = $new_post -> get_post_url();
                    $post_text = $new_post -> get_post_text();
                    $post_is_active = $new_post -> get_post_is_active();
                    // $post_creation_date = $new_post -> get_post_creation_date();
                    #
                    // Hacemos ahora el bindParam, usando solo variables
                    $sentence -> bindParam(':post_id', $post_id, PDO::PARAM_INT);
                    $sentence -> bindParam(':post_author_id', $post_author_id, PDO::PARAM_INT);
                    $sentence -> bindParam(':post_title', $post_title, PDO::PARAM_STR);
                    $sentence -> bindParam(':post_url', $post_url, PDO::PARAM_STR);
                    $sentence -> bindParam(':post_text', $post_text, PDO::PARAM_STR);
                    $sentence -> bindParam(':post_is_active', $post_is_active, PDO::PARAM_STR);

                    # Ejecuto la sentencia SQL ya preparada anteriormente
                    $the_post_was_updated = $sentence -> execute();
                    #
                } catch (PDOException $exc) {

                    // echo $exc -> getTraceAsString();
                    print 'ERROR: ' . $exc -> getMessage() . "<br>";
                }
            }

            // Devolvemos la variable de confirmación, para saber si se tuvo éxito al actualizar el post en la BD
            return $the_post_was_updated;

        }

        // *** Obtenciones ***
        public static function get_all_the_posts_by_descending_date($connection) {

            $posts = array();

            if (isset($connection))
            {

                try {

                    // Declaro el código SQL
                    $sql = "SELECT * FROM " . DB_NAME . ".posts ORDER BY post_creation_date DESC";

                    # Escapa los caracteres, para evitar el peligro de la inyección. Lo hace seguro y a prueba de errores
                    $sentence = $connection -> prepare($sql);

                    # Ejecuto la sentencia SQL ya preparada anteriormente
                    $sentence -> execute();

                    # Guardo en el array $result todos los posts
                    $result = $sentence -> fetchAll();

                    if (count($result)) # Si hay al menos un post...
                    {
                        foreach ($result as $row) {

                            // En cada última casilla del array $posts, metemos un objeto Post
                            $posts[] = new Post(
                                    $row['post_id'], $row['post_author_id'], $row['post_title'], $row['post_url'],
                                    #
                                    $row['post_text'], $row['post_is_active'], $row['post_creation_date']
                            );
                        }
                        # Devuelvo el array de posts
                        return $posts;
                    }
                } catch (PDOException $ex) {

                    print 'ERROR: ' . $ex -> getMessage() . "<br>";
                }
            }

        }

        public static function get_paged_posts_by_descending_date($connection, $initial_index, $page_limit) {

            $paged_posts = array();

            if (isset($connection))
            {

                try {

                    // Declaro el código SQL
                    $sql = "SELECT * FROM " . DB_NAME . ".posts ORDER BY post_creation_date DESC LIMIT :initial_index, :page_limit ";
                    // $sql = "SELECT * FROM " . DB_NAME . ".posts ORDER BY post_creation_date DESC LIMIT :page_limit OFFSET :initial_index";
                    #
                    # Escapa los caracteres, para evitar el peligro de la inyección. Lo hace seguro y a prueba de errores
                    $sentence = $connection -> prepare($sql);

                    // Hacemos ahora el bindParam, usando solo variables
                    $sentence -> bindParam(':page_limit', $page_limit, PDO::PARAM_INT);
                    $sentence -> bindParam(':initial_index', $initial_index, PDO::PARAM_INT);

                    # Ejecuto la sentencia SQL ya preparada anteriormente
                    $sentence -> execute();

                    # Guardo en el array $result todos los posts
                    $result = $sentence -> fetchAll();

                    if (count($result)) # Si hay al menos un post...
                    {
                        foreach ($result as $row) {
                            $paged_posts[] = new Post(
                                    $row['post_id'], $row['post_author_id'], $row['post_title'], $row['post_url'],
                                    #
                                    $row['post_text'], $row['post_is_active'], $row['post_creation_date']
                            );
                        }
                        # Devuelvo el array de posts
                        return $paged_posts;
                    }
                } catch (PDOException $ex) {

                    print 'ERROR: ' . $ex -> getMessage() . "<br>";
                }
            }

        }

        public static function get_post_by_url($connection, $post_url) {

            $post = NULL;

            if (isset($connection))
            {
                try {
                    // Declaro el código SQL
                    $sql = "SELECT * FROM " . DB_NAME . ".posts WHERE post_url LIKE :post_url";

                    # Escapa los caracteres, para evitar el peligro de la inyección. Lo hace seguro y a prueba de errores
                    $sentence = $connection -> prepare($sql);

                    // Hacemos ahora el bindParam, usando solo variables
                    $sentence -> bindParam(':post_url', $post_url, PDO::PARAM_STR);

                    # Ejecuto la sentencia SQL ya preparada anteriormente
                    $sentence -> execute();

                    # Guardo en el array $result el usuario (una sola entrada)
                    $result = $sentence -> fetch();

                    # Si hay al menos un post...
                    if (!empty($result))
                    { //  Si no está vacío...
                        // Recuperamos cada campo del post
                        $post = new Post(
                                $result['post_id'], $result['post_author_id'], $result['post_title'], $result['post_url'],
                                #
                                $result['post_text'], $result['post_is_active'], $result['post_creation_date']
                        );

                        # Devuelvo el post
                        return $post;
                    }
                } catch (PDOException $ex) {

                    print 'ERROR: ' . $ex -> getMessage() . "<br>";
                }
            }

        }

        public static function get_random_posts($connection, $limit) {

            $post = '';
            $posts = [];

            if (isset($connection))
            {
                try {
                    // Declaro el código SQL
                    $sql = "SELECT * FROM " . DB_NAME . ".posts ORDER BY RAND() LIMIT $limit";

                    # Escapa los caracteres, para evitar el peligro de la inyección. Lo hace seguro y a prueba de errores
                    $sentence = $connection -> prepare($sql);

                    // Hacemos ahora el bindParam, usando solo variables
                    //$sentence -> bindParam(':limit', $limit, PDO::PARAM_STR);
                    # Ejecuto la sentencia SQL ya preparada anteriormente
                    $sentence -> execute();

                    if ($limit > 1)
                    { // Si es más de un post...
                        # Guardo en el array $result las entradas
                        $result = $sentence -> fetchAll();

                        if (count($result)) # Si hay al menos un post...
                        { //  Si no está vacío...
                            // Recorro el array con los resultados
                            foreach ($result as $row) {

                                $posts[] = new Post(
                                        $row['post_id'], $row['post_author_id'], $row['post_title'], $row['post_url'],
                                        #
                                        $row['post_text'], $row['post_is_active'], $row['post_creation_date']
                                );
                            }

                            # Devuelvo los posts
                            return $posts;
                        }
                    }
                    else if ($limit == 1)
                    { // Si es un solo post...
                        # Guardo en el array $result la entrada
                        $result = $sentence -> fetch();

                        if (!empty($result))
                        { //  Si no está vacío...
                            // Recuperamos cada campo del post
                            $post = new Post(
                                    $result['post_id'], $result['post_author_id'], $result['post_title'], $result['post_url'],
                                    #
                                    $result['post_text'], $result['post_is_active'], $result['post_creation_date']
                            );

                            # Devuelvo el post
                            return $post;
                        }
                    }
                } catch (PDOException $ex) {

                    print 'ERROR: ' . $ex -> getMessage() . "<br>";
                }
            }

        }

        public static function get_post_by_id($connection, $post_id) {

            $post = NULL;

            if (isset($connection))
            {
                try {
                    // Declaro el código SQL
                    $sql = "SELECT * FROM " . DB_NAME . ".posts WHERE post_id = :post_id";

                    # Escapa los caracteres, para evitar el peligro de la inyección. Lo hace seguro y a prueba de errores
                    $sentence = $connection -> prepare($sql);

                    // Hacemos ahora el bindParam, usando solo variables
                    $sentence -> bindParam(':post_id', $post_id, PDO::PARAM_INT);

                    # Ejecuto la sentencia SQL ya preparada anteriormente
                    $sentence -> execute();

                    # Guardo en el array $result el post (una sola entrada)
                    $result = $sentence -> fetch();

                    # Si hay al menos un post...
                    if (!empty($result))
                    { //  Si no está vacío...
                        // Recuperamos cada campo del post
                        $post = new Post(
                                $result['post_id'], $result['post_author_id'], $result['post_title'], $result['post_url'],
                                #
                                $result['post_text'], $result['post_is_active'], $result['post_creation_date']
                        );

                        # Devuelvo el post
                        return $post;
                    }
                } catch (PDOException $ex) {

                    print 'ERROR: ' . $ex -> getMessage() . "<br>";
                }
            }

        }

        #***************************************************************************************************************
        #                                     *** Advanced Search ***
        #***************************************************************************************************************
        #
        // Valor único

        public static function get_posts_by_title_ord_by_date_desc($connection, $search_term) {

            $posts = array();
            $search_term = '%' . $search_term . '%';

            if (isset($connection))
            {

                try {

                    // Declaro el código SQL
                    $sql = "SELECT * FROM " . DB_NAME . ".posts "
                            . "WHERE post_title LIKE :search_term "
                            . "ORDER BY post_creation_date DESC LIMIT 25";

                    # Escapa los caracteres, para evitar el peligro de la inyección. Lo hace seguro y a prueba de errores
                    $sentence = $connection -> prepare($sql);

                    // Hacemos ahora el bindParam, usando solo variables
                    $sentence -> bindParam(':search_term', $search_term, PDO::PARAM_STR);

                    # Ejecuto la sentencia SQL ya preparada anteriormente
                    $sentence -> execute();

                    # Guardo en el array $result todos los posts
                    $result = $sentence -> fetchAll();

                    if (count($result)) # Si hay al menos un post...
                    {
                        foreach ($result as $row) {

                            // En cada última casilla del array $posts, metemos un objeto Post
                            $posts[] = new Post(
                                    $row['post_id'], $row['post_author_id'], $row['post_title'], $row['post_url'],
                                    #
                                    $row['post_text'], $row['post_is_active'], $row['post_creation_date']
                            );
                        }

                        # Devuelvo el array de posts
                        return $posts;
                    }
                } catch (PDOException $ex) {

                    print 'ERROR: ' . $ex -> getMessage() . "<br>";
                }
            }

        }

        public static function get_posts_by_title_ord_by_date_asc($connection, $search_term) {

            $posts = array();
            $search_term = '%' . $search_term . '%';

            if (isset($connection))
            {

                try {

                    // Declaro el código SQL
                    $sql = "SELECT * FROM " . DB_NAME . ".posts "
                            . "WHERE post_title LIKE :search_term "
                            . "ORDER BY post_creation_date ASC LIMIT 25";

                    # Escapa los caracteres, para evitar el peligro de la inyección. Lo hace seguro y a prueba de errores
                    $sentence = $connection -> prepare($sql);

                    // Hacemos ahora el bindParam, usando solo variables
                    $sentence -> bindParam(':search_term', $search_term, PDO::PARAM_STR);

                    # Ejecuto la sentencia SQL ya preparada anteriormente
                    $sentence -> execute();

                    # Guardo en el array $result todos los posts
                    $result = $sentence -> fetchAll();

                    if (count($result)) # Si hay al menos un post...
                    {
                        foreach ($result as $row) {

                            // En cada última casilla del array $posts, metemos un objeto Post
                            $posts[] = new Post(
                                    $row['post_id'], $row['post_author_id'], $row['post_title'], $row['post_url'],
                                    #
                                    $row['post_text'], $row['post_is_active'], $row['post_creation_date']
                            );
                        }

                        # Devuelvo el array de posts
                        return $posts;
                    }
                } catch (PDOException $ex) {

                    print 'ERROR: ' . $ex -> getMessage() . "<br>";
                }
            }

        }

        public static function get_posts_by_text_ord_by_date_desc($connection, $search_term) {

            $posts = array();
            $search_term = '%' . $search_term . '%';

            if (isset($connection))
            {

                try {

                    // Declaro el código SQL
                    $sql = "SELECT * FROM " . DB_NAME . ".posts "
                            . "WHERE post_text LIKE :search_term "
                            . "ORDER BY post_creation_date DESC LIMIT 25";

                    # Escapa los caracteres, para evitar el peligro de la inyección. Lo hace seguro y a prueba de errores
                    $sentence = $connection -> prepare($sql);

                    // Hacemos ahora el bindParam, usando solo variables
                    $sentence -> bindParam(':search_term', $search_term, PDO::PARAM_STR);

                    # Ejecuto la sentencia SQL ya preparada anteriormente
                    $sentence -> execute();

                    # Guardo en el array $result todos los posts
                    $result = $sentence -> fetchAll();

                    if (count($result)) # Si hay al menos un post...
                    {
                        foreach ($result as $row) {

                            // En cada última casilla del array $posts, metemos un objeto Post
                            $posts[] = new Post(
                                    $row['post_id'], $row['post_author_id'], $row['post_title'], $row['post_url'],
                                    #
                                    $row['post_text'], $row['post_is_active'], $row['post_creation_date']
                            );
                        }

                        # Devuelvo el array de posts
                        return $posts;
                    }
                } catch (PDOException $ex) {

                    print 'ERROR: ' . $ex -> getMessage() . "<br>";
                }
            }

        }

        public static function get_posts_by_text_ord_by_date_asc($connection, $search_term) {

            $posts = array();
            $search_term = '%' . $search_term . '%';

            if (isset($connection))
            {

                try {

                    // Declaro el código SQL
                    $sql = "SELECT * FROM " . DB_NAME . ".posts "
                            . "WHERE post_text LIKE :search_term "
                            . "ORDER BY post_creation_date ASC LIMIT 25";

                    # Escapa los caracteres, para evitar el peligro de la inyección. Lo hace seguro y a prueba de errores
                    $sentence = $connection -> prepare($sql);

                    // Hacemos ahora el bindParam, usando solo variables
                    $sentence -> bindParam(':search_term', $search_term, PDO::PARAM_STR);

                    # Ejecuto la sentencia SQL ya preparada anteriormente
                    $sentence -> execute();

                    # Guardo en el array $result todos los posts
                    $result = $sentence -> fetchAll();

                    if (count($result)) # Si hay al menos un post...
                    {
                        foreach ($result as $row) {

                            // En cada última casilla del array $posts, metemos un objeto Post
                            $posts[] = new Post(
                                    $row['post_id'], $row['post_author_id'], $row['post_title'], $row['post_url'],
                                    #
                                    $row['post_text'], $row['post_is_active'], $row['post_creation_date']
                            );
                        }

                        # Devuelvo el array de posts
                        return $posts;
                    }
                } catch (PDOException $ex) {

                    print 'ERROR: ' . $ex -> getMessage() . "<br>";
                }
            }

        }

        public static function get_posts_by_author_name_ord_by_date_desc($connection, $search_term) {

            $posts = array();
            $search_term = '%' . $search_term . '%';

            if (isset($connection))
            {

                try {

                    // Declaro el código SQL
                    $sql = "SELECT "
                            . "posts.post_id, "
                            . "posts.post_author_id, "
                            . "posts.post_title, "
                            . "posts.post_url, "
                            . "posts.post_text, "
                            . "posts.post_is_active, "
                            . "posts.post_creation_date "
                            . "FROM " . DB_NAME . ".posts INNER JOIN " . DB_NAME . ".users "
                            . "ON posts.post_author_id = users.user_id "
                            . "WHERE users.user_firstname LIKE :search_term "
                            . "OR users.user_lastname LIKE :search_term "
                            . "ORDER BY posts.post_creation_date DESC "
                            . "LIMIT 25";

                    # Escapa los caracteres, para evitar el peligro de la inyección. Lo hace seguro y a prueba de errores
                    $sentence = $connection -> prepare($sql);

                    // Hacemos ahora el bindParam, usando solo variables
                    $sentence -> bindParam(':search_term', $search_term, PDO::PARAM_STR);

                    # Ejecuto la sentencia SQL ya preparada anteriormente
                    $sentence -> execute();

                    # Guardo en el array $result todos los posts
                    $result = $sentence -> fetchAll();

                    if (count($result)) # Si hay al menos un post...
                    {
                        foreach ($result as $row) {

                            // En cada última casilla del array $posts, metemos un objeto Post
                            $posts[] = new Post(
                                    $row['post_id'], $row['post_author_id'], $row['post_title'], $row['post_url'],
                                    #
                                    $row['post_text'], $row['post_is_active'], $row['post_creation_date']
                            );
                        }

                        # Devuelvo el array de posts
                        return $posts;
                    }
                } catch (PDOException $ex) {

                    print 'ERROR: ' . $ex -> getMessage() . "<br>";
                }
            }

        }

        public static function get_posts_by_author_name_ord_by_date_asc($connection, $search_term) {

            $posts = array();
            $search_term = '%' . $search_term . '%';

            if (isset($connection))
            {

                try {

                    // Declaro el código SQL
                    $sql = "SELECT "
                            . "posts.post_id, "
                            . "posts.post_author_id, "
                            . "posts.post_title, "
                            . "posts.post_url, "
                            . "posts.post_text, "
                            . "posts.post_is_active, "
                            . "posts.post_creation_date "
                            . "FROM " . DB_NAME . ".posts INNER JOIN " . DB_NAME . ".users "
                            . "ON posts.post_author_id = users.user_id "
                            . "WHERE users.user_firstname LIKE :search_term "
                            . "OR users.user_lastname LIKE :search_term "
                            . "ORDER BY posts.post_creation_date ASC "
                            . "LIMIT 25";

                    # Escapa los caracteres, para evitar el peligro de la inyección. Lo hace seguro y a prueba de errores
                    $sentence = $connection -> prepare($sql);

                    // Hacemos ahora el bindParam, usando solo variables
                    $sentence -> bindParam(':search_term', $search_term, PDO::PARAM_STR);

                    # Ejecuto la sentencia SQL ya preparada anteriormente
                    $sentence -> execute();

                    # Guardo en el array $result todos los posts
                    $result = $sentence -> fetchAll();

                    if (count($result)) # Si hay al menos un post...
                    {
                        foreach ($result as $row) {

                            // En cada última casilla del array $posts, metemos un objeto Post
                            $posts[] = new Post(
                                    $row['post_id'], $row['post_author_id'], $row['post_title'], $row['post_url'],
                                    #
                                    $row['post_text'], $row['post_is_active'], $row['post_creation_date']
                            );
                        }

                        # Devuelvo el array de posts
                        return $posts;
                    }
                } catch (PDOException $ex) {

                    print 'ERROR: ' . $ex -> getMessage() . "<br>";
                }
            }

        }

        // Dos valores
        public static function get_posts_by_title_and_text_ord_by_date_desc($connection, $search_term) {

            $posts = array();
            $search_term = '%' . $search_term . '%';

            if (isset($connection))
            {

                try {

                    // Declaro el código SQL
                    $sql = "SELECT * FROM " . DB_NAME . ".posts "
                            . "WHERE post_title LIKE :search_term "
                            . "OR post_text LIKE :search_term "
                            . "ORDER BY post_creation_date DESC LIMIT 25";

                    # Escapa los caracteres, para evitar el peligro de la inyección. Lo hace seguro y a prueba de errores
                    $sentence = $connection -> prepare($sql);

                    // Hacemos ahora el bindParam, usando solo variables
                    $sentence -> bindParam(':search_term', $search_term, PDO::PARAM_STR);

                    # Ejecuto la sentencia SQL ya preparada anteriormente
                    $sentence -> execute();

                    # Guardo en el array $result todos los posts
                    $result = $sentence -> fetchAll();

                    if (count($result)) # Si hay al menos un post...
                    {
                        foreach ($result as $row) {

                            // En cada última casilla del array $posts, metemos un objeto Post
                            $posts[] = new Post(
                                    $row['post_id'], $row['post_author_id'], $row['post_title'], $row['post_url'],
                                    #
                                    $row['post_text'], $row['post_is_active'], $row['post_creation_date']
                            );
                        }

                        # Devuelvo el array de posts
                        return $posts;
                    }
                } catch (PDOException $ex) {

                    print 'ERROR: ' . $ex -> getMessage() . "<br>";
                }
            }

        }

        public static function get_posts_by_title_and_text_ord_by_date_asc($connection, $search_term) {

            $posts = array();
            $search_term = '%' . $search_term . '%';

            if (isset($connection))
            {

                try {

                    // Declaro el código SQL
                    $sql = "SELECT * FROM " . DB_NAME . ".posts "
                            . "WHERE post_title LIKE :search_term "
                            . "OR post_text LIKE :search_term "
                            . "ORDER BY post_creation_date ASC LIMIT 25";

                    # Escapa los caracteres, para evitar el peligro de la inyección. Lo hace seguro y a prueba de errores
                    $sentence = $connection -> prepare($sql);

                    // Hacemos ahora el bindParam, usando solo variables
                    $sentence -> bindParam(':search_term', $search_term, PDO::PARAM_STR);

                    # Ejecuto la sentencia SQL ya preparada anteriormente
                    $sentence -> execute();

                    # Guardo en el array $result todos los posts
                    $result = $sentence -> fetchAll();

                    if (count($result)) # Si hay al menos un post...
                    {
                        foreach ($result as $row) {

                            // En cada última casilla del array $posts, metemos un objeto Post
                            $posts[] = new Post(
                                    $row['post_id'], $row['post_author_id'], $row['post_title'], $row['post_url'],
                                    #
                                    $row['post_text'], $row['post_is_active'], $row['post_creation_date']
                            );
                        }

                        # Devuelvo el array de posts
                        return $posts;
                    }
                } catch (PDOException $ex) {

                    print 'ERROR: ' . $ex -> getMessage() . "<br>";
                }
            }

        }

        public static function get_posts_by_title_and_author_name_ord_by_date_desc($connection, $search_term) {

            $posts = array();
            $search_term = '%' . $search_term . '%';

            if (isset($connection))
            {

                try {

                    // Declaro el código SQL
                    $sql = "SELECT "
                            . "posts.post_id, "
                            . "posts.post_author_id, "
                            . "posts.post_title, "
                            . "posts.post_url, "
                            . "posts.post_text, "
                            . "posts.post_is_active, "
                            . "posts.post_creation_date "
                            . "FROM " . DB_NAME . ".posts LEFT JOIN " . DB_NAME . ".users "
                            . "ON posts.post_author_id = users.user_id "
                            . "WHERE posts.post_title LIKE :search_term "
                            . "OR users.user_firstname LIKE :search_term "
                            . "OR users.user_lastname LIKE :search_term "
                            . "ORDER BY posts.post_creation_date DESC "
                            . "LIMIT 25";

                    # Escapa los caracteres, para evitar el peligro de la inyección. Lo hace seguro y a prueba de errores
                    $sentence = $connection -> prepare($sql);

                    // Hacemos ahora el bindParam, usando solo variables
                    $sentence -> bindParam(':search_term', $search_term, PDO::PARAM_STR);

                    # Ejecuto la sentencia SQL ya preparada anteriormente
                    $sentence -> execute();

                    # Guardo en el array $result todos los posts
                    $result = $sentence -> fetchAll();

                    if (count($result)) # Si hay al menos un post...
                    {
                        foreach ($result as $row) {

                            // En cada última casilla del array $posts, metemos un objeto Post
                            $posts[] = new Post(
                                    $row['post_id'], $row['post_author_id'], $row['post_title'], $row['post_url'],
                                    #
                                    $row['post_text'], $row['post_is_active'], $row['post_creation_date']
                            );
                        }

                        # Devuelvo el array de posts
                        return $posts;
                    }
                } catch (PDOException $ex) {

                    print 'ERROR: ' . $ex -> getMessage() . "<br>";
                }
            }

        }

        public static function get_posts_by_title_and_author_name_ord_by_date_asc($connection, $search_term) {

            $posts = array();
            $search_term = '%' . $search_term . '%';

            if (isset($connection))
            {

                try {

                    // Declaro el código SQL
                    $sql = "SELECT "
                            . "posts.post_id, "
                            . "posts.post_author_id, "
                            . "posts.post_title, "
                            . "posts.post_url, "
                            . "posts.post_text, "
                            . "posts.post_is_active, "
                            . "posts.post_creation_date "
                            . "FROM " . DB_NAME . ".posts LEFT JOIN " . DB_NAME . ".users "
                            . "ON posts.post_author_id = users.user_id "
                            . "WHERE posts.post_title LIKE :search_term "
                            . "OR users.user_firstname LIKE :search_term "
                            . "OR users.user_lastname LIKE :search_term "
                            . "ORDER BY posts.post_creation_date ASC "
                            . "LIMIT 25";

                    # Escapa los caracteres, para evitar el peligro de la inyección. Lo hace seguro y a prueba de errores
                    $sentence = $connection -> prepare($sql);

                    // Hacemos ahora el bindParam, usando solo variables
                    $sentence -> bindParam(':search_term', $search_term, PDO::PARAM_STR);

                    # Ejecuto la sentencia SQL ya preparada anteriormente
                    $sentence -> execute();

                    # Guardo en el array $result todos los posts
                    $result = $sentence -> fetchAll();

                    if (count($result)) # Si hay al menos un post...
                    {
                        foreach ($result as $row) {

                            // En cada última casilla del array $posts, metemos un objeto Post
                            $posts[] = new Post(
                                    $row['post_id'], $row['post_author_id'], $row['post_title'], $row['post_url'],
                                    #
                                    $row['post_text'], $row['post_is_active'], $row['post_creation_date']
                            );
                        }

                        # Devuelvo el array de posts
                        return $posts;
                    }
                } catch (PDOException $ex) {

                    print 'ERROR: ' . $ex -> getMessage() . "<br>";
                }
            }

        }

        public static function get_posts_by_text_and_author_name_ord_by_date_desc($connection, $search_term) {

            $posts = array();
            $search_term = '%' . $search_term . '%';

            if (isset($connection))
            {

                try {

                    // Declaro el código SQL
                    $sql = "SELECT "
                            . "posts.post_id, "
                            . "posts.post_author_id, "
                            . "posts.post_title, "
                            . "posts.post_url, "
                            . "posts.post_text, "
                            . "posts.post_is_active, "
                            . "posts.post_creation_date "
                            . "FROM " . DB_NAME . ".posts LEFT JOIN " . DB_NAME . ".users "
                            . "ON posts.post_author_id = users.user_id "
                            . "WHERE posts.post_text LIKE :search_term "
                            . "OR users.user_firstname LIKE :search_term "
                            . "OR users.user_lastname LIKE :search_term "
                            . "ORDER BY posts.post_creation_date DESC "
                            . "LIMIT 25";

                    # Escapa los caracteres, para evitar el peligro de la inyección. Lo hace seguro y a prueba de errores
                    $sentence = $connection -> prepare($sql);

                    // Hacemos ahora el bindParam, usando solo variables
                    $sentence -> bindParam(':search_term', $search_term, PDO::PARAM_STR);

                    # Ejecuto la sentencia SQL ya preparada anteriormente
                    $sentence -> execute();

                    # Guardo en el array $result todos los posts
                    $result = $sentence -> fetchAll();

                    if (count($result)) # Si hay al menos un post...
                    {
                        foreach ($result as $row) {

                            // En cada última casilla del array $posts, metemos un objeto Post
                            $posts[] = new Post(
                                    $row['post_id'], $row['post_author_id'], $row['post_title'], $row['post_url'],
                                    #
                                    $row['post_text'], $row['post_is_active'], $row['post_creation_date']
                            );
                        }

                        # Devuelvo el array de posts
                        return $posts;
                    }
                } catch (PDOException $ex) {

                    print 'ERROR: ' . $ex -> getMessage() . "<br>";
                }
            }

        }

        public static function get_posts_by_text_and_author_name_ord_by_date_asc($connection, $search_term) {

            $posts = array();
            $search_term = '%' . $search_term . '%';

            if (isset($connection))
            {

                try {

                    // Declaro el código SQL
                    $sql = "SELECT "
                            . "posts.post_id, "
                            . "posts.post_author_id, "
                            . "posts.post_title, "
                            . "posts.post_url, "
                            . "posts.post_text, "
                            . "posts.post_is_active, "
                            . "posts.post_creation_date "
                            . "FROM " . DB_NAME . ".posts LEFT JOIN " . DB_NAME . ".users "
                            . "ON posts.post_author_id = users.user_id "
                            . "WHERE posts.post_text LIKE :search_term "
                            . "OR users.user_firstname LIKE :search_term "
                            . "OR users.user_lastname LIKE :search_term "
                            . "ORDER BY posts.post_creation_date ASC "
                            . "LIMIT 25";

                    # Escapa los caracteres, para evitar el peligro de la inyección. Lo hace seguro y a prueba de errores
                    $sentence = $connection -> prepare($sql);

                    // Hacemos ahora el bindParam, usando solo variables
                    $sentence -> bindParam(':search_term', $search_term, PDO::PARAM_STR);

                    # Ejecuto la sentencia SQL ya preparada anteriormente
                    $sentence -> execute();

                    # Guardo en el array $result todos los posts
                    $result = $sentence -> fetchAll();

                    if (count($result)) # Si hay al menos un post...
                    {
                        foreach ($result as $row) {

                            // En cada última casilla del array $posts, metemos un objeto Post
                            $posts[] = new Post(
                                    $row['post_id'], $row['post_author_id'], $row['post_title'], $row['post_url'],
                                    #
                                    $row['post_text'], $row['post_is_active'], $row['post_creation_date']
                            );
                        }

                        # Devuelvo el array de posts
                        return $posts;
                    }
                } catch (PDOException $ex) {

                    print 'ERROR: ' . $ex -> getMessage() . "<br>";
                }
            }

        }

        // Tres valores
        public static function get_posts_by_title_by_text_and_author_name_ord_by_date_desc($connection, $search_term) {

            $posts = array();
            $search_term = '%' . $search_term . '%';

            if (isset($connection))
            {

                try {

                    // Declaro el código SQL
                    $sql = "SELECT "
                            . "posts.post_id, "
                            . "posts.post_author_id, "
                            . "posts.post_title, "
                            . "posts.post_url, "
                            . "posts.post_text, "
                            . "posts.post_is_active, "
                            . "posts.post_creation_date "
                            . "FROM " . DB_NAME . ".posts LEFT JOIN " . DB_NAME . ".users "
                            . "ON posts.post_author_id = users.user_id "
                            . "WHERE posts.post_title LIKE :search_term "
                            . "OR posts.post_text LIKE :search_term "
                            . "OR users.user_firstname LIKE :search_term "
                            . "OR users.user_lastname LIKE :search_term "
                            . "ORDER BY posts.post_creation_date DESC "
                            . "LIMIT 25";

                    # Escapa los caracteres, para evitar el peligro de la inyección. Lo hace seguro y a prueba de errores
                    $sentence = $connection -> prepare($sql);

                    // Hacemos ahora el bindParam, usando solo variables
                    $sentence -> bindParam(':search_term', $search_term, PDO::PARAM_STR);

                    # Ejecuto la sentencia SQL ya preparada anteriormente
                    $sentence -> execute();

                    # Guardo en el array $result todos los posts
                    $result = $sentence -> fetchAll();

                    if (count($result)) # Si hay al menos un post...
                    {
                        foreach ($result as $row) {

                            // En cada última casilla del array $posts, metemos un objeto Post
                            $posts[] = new Post(
                                    $row['post_id'], $row['post_author_id'], $row['post_title'], $row['post_url'],
                                    #
                                    $row['post_text'], $row['post_is_active'], $row['post_creation_date']
                            );
                        }

                        # Devuelvo el array de posts
                        return $posts;
                    }
                } catch (PDOException $ex) {

                    print 'ERROR: ' . $ex -> getMessage() . "<br>";
                }
            }

        }

        public static function get_posts_by_title_by_text_and_author_name_ord_by_date_asc($connection, $search_term) {

            $posts = array();
            $search_term = '%' . $search_term . '%';

            if (isset($connection))
            {

                try {

                    // Declaro el código SQL
                    $sql = "SELECT "
                            . "posts.post_id, "
                            . "posts.post_author_id, "
                            . "posts.post_title, "
                            . "posts.post_url, "
                            . "posts.post_text, "
                            . "posts.post_is_active, "
                            . "posts.post_creation_date "
                            . "FROM " . DB_NAME . ".posts LEFT JOIN " . DB_NAME . ".users "
                            . "ON posts.post_author_id = users.user_id "
                            . "WHERE posts.post_title LIKE :search_term "
                            . "OR posts.post_text LIKE :search_term "
                            . "OR users.user_firstname LIKE :search_term "
                            . "OR users.user_lastname LIKE :search_term "
                            . "ORDER BY posts.post_creation_date ASC "
                            . "LIMIT 25";

                    # Escapa los caracteres, para evitar el peligro de la inyección. Lo hace seguro y a prueba de errores
                    $sentence = $connection -> prepare($sql);

                    // Hacemos ahora el bindParam, usando solo variables
                    $sentence -> bindParam(':search_term', $search_term, PDO::PARAM_STR);

                    # Ejecuto la sentencia SQL ya preparada anteriormente
                    $sentence -> execute();

                    # Guardo en el array $result todos los posts
                    $result = $sentence -> fetchAll();

                    if (count($result)) # Si hay al menos un post...
                    {
                        foreach ($result as $row) {

                            // En cada última casilla del array $posts, metemos un objeto Post
                            $posts[] = new Post(
                                    $row['post_id'], $row['post_author_id'], $row['post_title'], $row['post_url'],
                                    #
                                    $row['post_text'], $row['post_is_active'], $row['post_creation_date']
                            );
                        }

                        # Devuelvo el array de posts
                        return $posts;
                    }
                } catch (PDOException $ex) {

                    print 'ERROR: ' . $ex -> getMessage() . "<br>";
                }
            }

        }

        // *** Conteos ***
        public static function count_active_posts_by_author_id($connection, $post_author_id) {

            $total_active_posts = 0;

            if (isset($connection))
            {
                try {

                    // Declaro el código SQL
                    $sql = "SELECT COUNT(*) AS total_active_posts FROM " . DB_NAME . ".posts WHERE post_author_id = :post_author_id AND post_is_active = 1";

                    # Escapa los caracteres, para evitar inyecciones SQL. Lo hace seguro y a prueba de errores
                    $sentence = $connection -> prepare($sql);

                    // Hacemos ahora el bindParam, usando solo variables
                    $sentence -> bindParam(':post_author_id', $post_author_id, PDO::PARAM_INT);

                    # Ejecuto la sentencia SQL ya preparada anteriormente
                    $sentence -> execute();

                    # Guardo en la variable $result la cantidad de usuarios
                    $result = $sentence -> fetch();

                    // $total_active_posts = count($result);
                    $total_active_posts = $result['total_active_posts'];

                    return $total_active_posts;
                } catch (PDOException $ex) {

                    print 'ERROR: ' . $ex -> getMessage() . "<br>";
                }
            }

        }

        public static function count_unactive_posts_by_author_id($connection, $post_author_id) {

            $total_unactive_posts = 0;

            if (isset($connection))
            {
                try {

                    // Declaro el código SQL
                    $sql = "SELECT COUNT(*) AS total_unactive_posts FROM " . DB_NAME . ".posts WHERE post_author_id = :post_author_id AND post_is_active = 0";

                    # Escapa los caracteres, para evitar inyecciones SQL. Lo hace seguro y a prueba de errores
                    $sentence = $connection -> prepare($sql);

                    // Hacemos ahora el bindParam, usando solo variables
                    $sentence -> bindParam(':post_author_id', $post_author_id, PDO::PARAM_INT);

                    # Ejecuto la sentencia SQL ya preparada anteriormente
                    $sentence -> execute();

                    # Guardo en la variable $result la cantidad de usuarios
                    $result = $sentence -> fetch();

                    // $total_unactive_posts = count($result);
                    $total_unactive_posts = $result['total_unactive_posts'];

                    return $total_unactive_posts;
                } catch (PDOException $ex) {

                    print 'ERROR: ' . $ex -> getMessage() . "<br>";
                }
            }

        }

        public static function get_posts_and_comments_amount_by_author_id_ordered_by_date_desc($connection, $user_id) {

            $posts_and_comments_amount = [];

            if (isset($connection))
            {

                try {

                    // Declaro el código SQL
                    $sql = "SELECT posts.post_id, posts.post_author_id, posts.post_title, posts.post_url, 
                        posts.post_text, posts.post_is_active, posts.post_creation_date, COUNT(comments.comment_id) AS 
                        'comments_amount' FROM " . DB_NAME . ".posts LEFT JOIN " . DB_NAME . ".comments ON posts.post_id = comments.comment_post_id 
                        WHERE posts.post_author_id = :author_id GROUP BY posts.post_id 
                        ORDER BY posts.post_creation_date DESC";

                    # Escapa los caracteres, para evitar el peligro de la inyección. Lo hace seguro y a prueba de errores
                    $sentence = $connection -> prepare($sql);

                    // Hacemos ahora el bindParam, usando solo variables
                    $sentence -> bindParam(':author_id', $user_id, PDO::PARAM_STR);

                    # Ejecuto la sentencia SQL ya preparada anteriormente
                    $sentence -> execute();

                    # Guardo en el array $result todos los posts
                    $result = $sentence -> fetchAll();

                    if (count($result)) # Si hay al menos un post...
                    {
                        foreach ($result as $row) {

                            //En cada última casilla del array $posts_and_comments_amount metemos un array de dos 
                            //casillas, la 1ra un objeto Post y la 2da con un comments_amount
                            $posts_and_comments_amount[] = array(
                                new Post($row['post_id'], $row['post_author_id'], $row['post_title'], $row['post_url'],
                                        #
                                        $row['post_text'], $row['post_is_active'], $row['post_creation_date']
                                ), $row['comments_amount']
                            );
                        }
                    }
                } catch (PDOException $ex) {

                    print 'ERROR: ' . $ex -> getMessage() . "<br>";
                }

                # Devuelvo el array bidimensional de posts y comments_amount
                return $posts_and_comments_amount;
            }

        }

        // *** Verificaciones de Existencia ***
        public static function post_exist_by_url($connection, $post_url) {


            // Declaro una variable booleana de confirmación de éxito al encontrar el post
            $the_post_exist = false;

            if (isset($connection))
            {
                try {
                    // Declaro el código SQL
                    $sql = "SELECT * FROM " . DB_NAME . ".posts WHERE post_url = :post_url";

                    # Escapa los caracteres, para evitar el peligro de la inyección. Lo hace seguro y a prueba de errores
                    $sentence = $connection -> prepare($sql);

                    // Hacemos ahora el bindParam, usando solo variables
                    $sentence -> bindParam(':post_url', $post_url, PDO::PARAM_STR);

                    # Ejecuto la sentencia SQL ya preparada anteriormente
                    $sentence -> execute();

                    # Guardo en el array $result todos los posts con la url especificado
                    $result = $sentence -> fetchAll();

                    if (count($result)) # Si hay al menos un post con ese url...
                    {
                        // Especifico en la variable de confirmación
                        $the_post_exist = true;
                    }
                    #
                } catch (PDOException $exc) {
                    // echo $exc -> getTraceAsString();
                    print 'ERROR: ' . $exc -> getMessage() . "<br>";
                }
            }

            // Devolvemos la variable de confirmación, para saber si se encontró el post en la base de datos
            return $the_post_exist;

        }

        public static function post_exist_by_title($connection, $post_title) {

            // Declaro una variable booleana de confirmación de éxito al encontrar el post
            $the_post_exist = false;

            if (isset($connection))
            {
                try {
                    // Declaro el código SQL
                    $sql = "SELECT * FROM " . DB_NAME . ".posts WHERE post_title = :post_title";

                    # Escapa los caracteres, para evitar el peligro de la inyección. Lo hace seguro y a prueba de errores
                    $sentence = $connection -> prepare($sql);

                    // Hacemos ahora el bindParam, usando solo variables
                    $sentence -> bindParam(':post_title', $post_title, PDO::PARAM_STR);

                    # Ejecuto la sentencia SQL ya preparada anteriormente
                    $sentence -> execute();

                    # Guardo en el array $result todos los posts con el title especificado
                    $result = $sentence -> fetchAll();

                    if (count($result)) # Si hay al menos un post con ese title...
                    {
                        // Especifico en la variable de confirmación
                        $the_post_exist = true;
                    }
                    #
                } catch (PDOException $exc) {
                    // echo $exc -> getTraceAsString();
                    print 'ERROR: ' . $exc -> getMessage() . "<br>";
                }
            }

            // Devolvemos la variable de confirmación, para saber si se encontró el post en la base de datos
            return $the_post_exist;

        }

    }
    