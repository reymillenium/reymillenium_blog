<?php

    include_once 'app/config.inc.php';
//    include_once CONNECTION_URL;
//
//    include_once USER_CLASS_URL;
//    include_once POST_CLASS_URL;
//    include_once COMMENT_CLASS_URL;
//
//    include_once USER_REPOSITORY_URL;
//    include_once POST_REPOSITORY_URL;
//    include_once COMMENT_REPOSITORY_URL;
//
//    include_once SESSION_CONTROL_URL;
//    include_once REDIRECTION_URL;


    // Almacenamos en un array la información de la url (servidor, parámetros, ruta, todo). Le pasamos la ruta
    $url_components = parse_url($_SERVER['REQUEST_URI']);

    // Recuperamos solo la ruta, excluyendo el servidor
    $path = $url_components['path'];

    // Dividimos el string path a partir del caracter / y guardamos en un array sus distintas partes
    $path_parts = explode("/", $path);

    // Reasignamos el array a una forma tratada. Cualquier índice del array que contenga un string vacío, apuntará a no definido. Aún está feo...
    $path_parts = array_filter($path_parts);

    // Volvemos a limpiar el array. Traceamos el array, empezando por el índice 0. Todos los índices vacíos del array se eliminarán
    $path_parts = array_slice($path_parts, 0);

    // Usamos una variable para especificar la ruta y la iniciamos en la página de error en el servidor o ruta incorrecta
    $chosen_path = 'views/404.php';

    // Verificamos que se haya entrado al Blog (reymillenium_blog)
    if ($path_parts[0] == ROOT_FOLDER_NAME)
    { // Si se ha entrado al blog correctamente...
        # **************************************************************************************************************
        #                                    SI HAY 1 SOLA PARTE EN LA RUTA
        # **************************************************************************************************************
        if (count($path_parts) == 1)
        { // Si hemos entrado a blog y nada más (home)...
            $chosen_path = 'views/home.php';
        }
        # **************************************************************************************************************
        #                                    SI HAY 2 PARTES EN LA RUTA
        # **************************************************************************************************************
        else if (count($path_parts) == 2) // Si hay algo más además de blog/...
        {
            switch ($path_parts[1]) {
                case 'authors_page':
                    $chosen_path = 'views/authors_page.php';
                    break;

                case 'db_filling_script':
                    $chosen_path = 'scripts/db_filling_script.php';
                    break;

                case 'favorits_page':
                    $chosen_path = 'views/favorits_page.php';
                    break;

                case 'manager_page':
                    $actual_manager = 'generic';
                    $chosen_path = 'views/manager_page.php';
                    break;

                case 'new_post_page':
                    $chosen_path = 'views/posts/new_post_page.php';
                    break;

                case 'edited_post_page':
                    $chosen_path = 'views/posts/edited_post_page.php';
                    break;

                case 'posts_page':
                    $chosen_path = 'views/posts/posts_page.php';
                    break;

                case 'user_login_page':
                    $chosen_path = 'views/users/user_login_page.php';
                    break;

                case 'user_logout_page':
                    $reason = 'logout';

                    include_once 'app/config.inc.php';
                    include_once CONNECTION_URL;

                    include_once SESSION_CONTROL_URL;
                    include_once REDIRECTION_URL;

                    // Eliminamos la sesión
                    SessionControl::close_session();

                    // Redirigimos al usuario de nuevo a esta página, para refrescar la interfaz
                    Redirection::redirect(USER_LOGIN_PAGE_URL);

                    $chosen_path = 'views/users/user_logout_page.php';
                    break;

                case 'user_registration_page':
                    $chosen_path = 'views/users/user_registration_page.php';
                    break;

                case 'delete_post':
                    $chosen_path = 'scripts/delete_post_script.php';
                    break;

                // *** Users ***

                case 'delete_user':
                    $chosen_path = 'scripts/delete_user_script.php';
                    break;

                // *** Página de la Recuperación de Contrasena ***
                case 'password_recover_page':
                    $chosen_path = 'views/password_recoveries/password_recover_page.php';
                    break;

                // *** Script para la Recuperación de Contrasena ***
                case 'generate_secret_url':
                    $chosen_path = 'scripts/generate_secret_url_script.php';
                    break;

                // Página para probar el envío de emails
                case 'mail_test_page':
                    $chosen_path = 'views/password_recoveries/mail_test_page.php';
                    break;

                // Página para realizar las búsquedas
                case 'search_page':
                    $chosen_path = 'views/search_page.php';
                    break;

                // Página para que el usuario pueda ver y/o editar sus propios campos (incluyendo imágenes)
                case 'user_profile_page':
                    $chosen_path = 'views/users/user_profile_page.php';
                    break;
            }
        }
        # **************************************************************************************************************
        #                                    SI HAY 3 PARTES EN LA RUTA
        # **************************************************************************************************************
        else if (count($path_parts) == 3) // Si hay 3 partes...
        {

            // En dependencia del segundo valor de la ruta...
            switch ($path_parts[1]) {

                // Página de notificación de registro correcto del usuario
                case 'correct_user_registration_page':
                    $user_firstname = $path_parts[2];
                    $chosen_path = 'views/users/correct_user_registration_page.php';
                    break;

                // Página de visualización de la entrada (post)
                case 'post_page':

                    // Extraemos la ruta
                    $url = $path_parts[2];

                    include_once 'app/config.inc.php';
                    include_once CONNECTION_URL;

                    //include_once USER_CLASS_URL;
                    //include_once POST_CLASS_URL;
                    //include_once COMMENT_CLASS_URL;

                    //include_once USER_REPOSITORY_URL;
                    include_once POST_REPOSITORY_URL;
                    include_once COMMENT_REPOSITORY_URL;

                    include_once SESSION_CONTROL_URL;
                    include_once REDIRECTION_URL;

                    // Abrimos la conexión
                    Connection::open_connection();

                    // Recuperamos el Post por su url
                    $post = PostRepository::get_post_by_url(Connection::get_connection(), $url);

                    // Verificamos la existencia o no del Post en la BD
                    if ($post != NULL)
                    { // Y si existe la entrada...
                        // Obtenemos entonces 3 posts al azar para colocarlos debajo del post hallado anteriormente
                        $random_posts = PostRepository::get_random_posts(Connection::get_connection(), 3);

                        // Obtenemos todos los comentarios de este post...
                        $comments_of_the_post = CommentRepository::get_comments_by_post_id(Connection::get_connection(), $post -> get_post_id());

                        // Y redirigimos entonces a la página de la entrada (post)
                        $chosen_path = 'views/posts/post_page.php';
                    }
                    break;

                // Página de Login
                case 'user_login_page':
                    $user_firstname = $path_parts[2];
                    $chosen_path = 'views/users/correct_user_registration_page.php';
                    break;

                // Página Gestor de Contenido (Posts, Comentarios, Favoritos, Usuarios?)
                case 'manager_page':

                    // En dependencia de la 3ra parte de la ruta
                    switch ($path_parts[2]) {

                        // Gestor Genérico
                        case 'generic':
                            $actual_manager = 'generic';
                            break;

                        // Gestor de Entradas (posts)
                        case 'posts':
                            $actual_manager = 'posts';
                            break;

                        // Gestor de Comentarios
                        case 'comments':
                            $actual_manager = 'comments';
                            break;

                        // Gestor de Favoritos
                        case 'favorits':
                            $actual_manager = 'favorits';
                            break;

                        // Gestor de Usuarios
                        case 'users':
                            $actual_manager = 'users';
                            break;
                    }

                    $chosen_path = 'views/manager_page.php';
                    break;

                // Página donde se escribe la nueva contraseña para substituir la vieja
                case 'rewrite_password_page':
                    $personal_url = $path_parts[2];
                    $chosen_path = 'views/password_recoveries/rewrite_password_page.php';
                    break;
            }
        }
    }

    // Redirigimos hacia la ruta escogida
    include_once $chosen_path;
    