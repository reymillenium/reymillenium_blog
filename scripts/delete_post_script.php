<?php

    //session_start();
    include_once 'app/config.inc.php';
    include_once CONNECTION_URL;
    
    include_once POST_REPOSITORY_URL;
    include_once REDIRECTION_URL;

    $line_break = '<br>';

    if (isset($_POST['delete_post']))
    {
        // Guardamos en una variable el post_id
        $post_id = $_POST['delete_post_id'];

        // Abrimos la conexión
        Connection::open_connection();

        // Intentamos borrar el Post en la base de datos
        $the_post_and_its_comments_were_deleted = PostRepository::delete_post_and_its_comments_by_post_id(Connection::get_connection(), $post_id);

        // Cerramos la conexión hayamos tenido éxito o no
        Connection::close_connection();

        if ($the_post_and_its_comments_were_deleted)
        {  // Si el Post y sus posibles comentarios fueron todos borrados exitosamente...
            # 
            // Redireccionamos hacia el Gestor de Posts para mostrar el resultado luego del borrado
            Redirection::redirect(MANAGER_PAGE_POSTS_URL);
        }
        else
        {
            echo $line_break . 'No se pudo borrar el Post con el post_id = ' . $post_id . $line_break;
//            echo '<script language="javascript" type= "text/javascript">alertify.alert("Lo sentimos ' . $_SESSION['user_firstname'] . ', ' . $line_break . 'no se pudo borrar el Post con el post_id = ' . $post_id . ' en la BD");</script>';
        }
    }
    else
    {
        // Redireccionamos hacia el Gestor de Posts
        Redirection::redirect(MANAGER_PAGE_POSTS_URL);
    }

    