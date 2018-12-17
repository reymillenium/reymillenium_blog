
<?php

    include_once 'app/config.inc.php';
    include_once CONNECTION_URL;
    
    include_once DIRTY_WORD_CLASS_URL;

    class DirtyWordRepository {

        public static function insert_dirty_word($connection, $new_dirty_word) {

            // Declaro una variable booleana de confirmación de éxito al insertar el comment
            $the_comment_was_inserted = false;

            if (isset($connection))
            {
                try {

                    // Declaro el código SQL
                    $sql = "INSERT INTO " . DB_NAME . ".comments (comment_author_id, comment_post_id, comment_title, comment_text, comment_creation_date)"
                            . "VALUES (:comment_author_id, :comment_post_id, :comment_title, :comment_text, NOW())";

                    # Escapa los caracteres, para evitar el peligro de la inyección. Lo hace seguro y a prueba de errores
                    $sentence = $connection -> prepare($sql);

                    // Volcamos los campos del usuario en variables, pues la ultima actualizacion de PHP no acepta sino variables en el bindParam
                    $comment_author_id = $new_comment -> get_comment_author_id();
                    $comment_post_id = $new_comment -> get_comment_post_id();
                    $comment_title = $new_comment -> get_comment_title();
                    $comment_text = $new_comment -> get_comment_text();
                    // $comment_creation_date = $new_comment -> get_comment_creation_date();
                    #
                    // Hacemos ahora el bindParam, usando solo variables
                    $sentence -> bindParam(':comment_author_id', $comment_author_id, PDO::PARAM_STR);
                    $sentence -> bindParam(':comment_post_id', $comment_post_id, PDO::PARAM_STR);
                    $sentence -> bindParam(':comment_title', $comment_title, PDO::PARAM_STR);
                    $sentence -> bindParam(':comment_text', $comment_text, PDO::PARAM_STR);

                    # Ejecuto la sentencia SQL ya preparada anteriormente
                    $the_comment_was_inserted = $sentence -> execute();
                    #
                } catch (PDOException $exc) {

                    // echo $exc -> getTraceAsString();
                    print 'ERROR: ' . $exc -> getMessage() . "<br>";
                }
            }

            // Devolvemos la variable de confirmación, para saber si se tuvo éxito al insertar el comment en la BD
            return $the_comment_was_inserted;

        }

        public static function get_dirty_word_by_id($connection, $comment_post_id) {

            $comments = array();

            if (isset($connection))
            {

                try {

                    $sql = "SELECT * FROM " . DB_NAME . ".comments WHERE comment_post_id = :comment_post_id";

                    # Escapa los caracteres, para evitar el peligro de la inyección. Lo hace seguro y a prueba de errores
                    $sentence = $connection -> prepare($sql);

                    // Hacemos ahora el bindParam, usando solo variables
                    $sentence -> bindParam(':comment_post_id', $comment_post_id, PDO::PARAM_STR);

                    # Ejecuto la sentencia SQL ya preparada anteriormente
                    $sentence -> execute();

                    # Guardo en el array $result todos los comments
                    $result = $sentence -> fetchAll();

                    if (count($result)) # Si hay al menos un comment...
                    {
                        foreach ($result as $row) {
                            $comments[] = new Comment(
                                    $row['comment_id'], $row['comment_author_id'], $row['comment_post_id'],
                                    #
                                    $row['comment_title'], $row['comment_text'], $row['comment_creation_date']
                            );
                        }
                    }
                } catch (PDOException $ex) {

                    print 'ERROR: ' . $ex -> getMessage() . "<br>";
                }
            }

            # Devuelvo el array de comments
            return $comments;

        }

        public static function count_comments_by_author_id($connection, $comment_author_id) {

            $total_comments = 0;

            if (isset($connection))
            {
                try {

                    // Declaro el código SQL
                    $sql = "SELECT COUNT(*) AS total_comments FROM " . DB_NAME . ".comments WHERE comment_author_id = :comment_author_id";

                    # Escapa los caracteres, para evitar inyecciones SQL. Lo hace seguro y a prueba de errores
                    $sentence = $connection -> prepare($sql);

                    // Hacemos ahora el bindParam, usando solo variables
                    $sentence -> bindParam(':comment_author_id', $comment_author_id, PDO::PARAM_INT);

                    # Ejecuto la sentencia SQL ya preparada anteriormente
                    $sentence -> execute();

                    # Guardo en la variable $result la cantidad de usuarios
                    $result = $sentence -> fetch();

                    // $total_comments = count($result);
                    $total_comments = $result['total_comments'];

                    return $total_comments;
                } catch (PDOException $ex) {

                    print 'ERROR: ' . $ex -> getMessage() . "<br>";
                }
            }

        }

    }
    