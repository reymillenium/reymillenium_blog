<?php

    //session_start();
    include_once 'app/config.inc.php';
    include_once CONNECTION_URL;

    include_once USER_REPOSITORY_URL;

    include_once REDIRECTION_URL;

    $line_break = '<br>';

    if (isset($_POST['delete_user']))
    {
        // Guardamos en una variable el user_id
        $user_id = $_POST['delete_user_id'];

        // Abrimos la conexión
        Connection::open_connection();

        // Intentamos borrar el User en la base de datos
        $the_user_and_its_posts_and_comments_were_deleted = UserRepository::delete_user_and_its_posts_and_comments_by_user_id(Connection::get_connection(), $user_id);

        // Cerramos la conexión hayamos tenido éxito o no
        Connection::close_connection();

        if ($the_user_and_its_posts_and_comments_were_deleted)
        {  // Si el User y sus posibles Posts y Comentarios fueron todos borrados exitosamente...
            # 
            // Redireccionamos hacia el Gestor de Users para mostrar el resultado luego del borrado
            Redirection::redirect(MANAGER_PAGE_USERS_URL);
        }
        else
        {
            echo $line_break . 'No se pudo borrar el User con el user_id = ' . $user_id . $line_break;
//            echo '<script language="javascript" type= "text/javascript">alertify.alert("Lo sentimos ' . $_SESSION['user_firstname'] . ', ' . $line_break . 'no se pudo borrar el User con el user_id = ' . $user_id . ' en la BD");</script>';
        }
    }
    else
    {
        // Redireccionamos hacia el Gestor de Users
        Redirection::redirect(MANAGER_PAGE_USERS_URL);
    }

    