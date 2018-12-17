<?php

    include 'app/config.inc.php';
    include_once CONNECTION_URL;

    include_once POST_REPOSITORY_URL;
    include_once COMMENT_REPOSITORY_URL;
    include_once USER_REPOSITORY_URL;

    include_once DATE_UTILITIES_URL;

    // Defino algunas variables utilitarias
    $line_break = '<br>';

    switch ($actual_manager) {

        // Gestor Genérico
        case 'generic':
            $page_title = 'Gestor de Contenido';
            break;

        // Gestor de Entradas (posts)
        case 'posts':
            $page_title = 'Gestor de Entradas';
            break;

        // Gestor de Comentarios
        case 'comments':
            $page_title = 'Gestor de Comentarios';
            break;

        // Gestor de Favoritos
        case 'favorits':
            $page_title = 'Gestor de Favoritos';
            break;

        // Gestor de Usuarios
        case 'users':
            $page_title = 'Gestor de Usuarios';
            break;
    }


    // Cargo la declaración de mi página web
    include_once PAGE_HEAD_DECLARATION_URL;

    // Cargo el encabezado de la página html
    include_once PAGE_HEADER_URL;

?>

<!-- Main Content Container Begin -->
<div class="container-fluid">
    <div class="row">

        <?php include_once MANAGER_PAGE_LEFT_COLUMN_URL; ?>

        <div id="div_right_column" class="col-md-8">

            <?php

                $active_posts_amount = PostRepository::count_active_posts_by_author_id(Connection::get_connection(), $_SESSION['user_id']);
                $unactive_posts_amount = PostRepository::count_unactive_posts_by_author_id(Connection::get_connection(), $_SESSION['user_id']);
                $comments_amount = CommentRepository::count_comments_by_author_id(Connection::get_connection(), $_SESSION['user_id']);

                switch ($actual_manager) {

                    // Plantilla de Gestión de las Entradas (posts)
                    case 'posts':
                        $posts_and_comments_amount = PostRepository::get_posts_and_comments_amount_by_author_id_ordered_by_date_desc(Connection::get_connection(), $_SESSION['user_id']);
                        include_once MANAGER_PAGE_POSTS_TEMPLATE_URL;
                        break;

                    // Plantilla de Gestión de los Comentarios (comments)
                    case 'comments':
                        include_once MANAGER_PAGE_COMMENTS_TEMPLATE_URL;
                        break;

                    // Plantilla de Gestión de los Favoritos (favorits)
                    case 'favorits':
                        include_once MANAGER_PAGE_FAVORITS_TEMPLATE_URL;
                        break;

                    // Plantilla de Gestión de los Usuarios (users)
                    case 'users':
                        $users = UserRepository::get_all_the_users(Connection::get_connection());
                        include_once MANAGER_PAGE_USERS_TEMPLATE_URL;
                        break;

                    // Por defecto...
                    case 'generic':
                        include_once MANAGER_PAGE_GENERIC_TEMPLATE_URL;
                        break;
                }

            ?>

        </div>

    </div>
</div>
<!-- Main Content Container End -->

<?php include_once PAGE_FOOTER_URL; ?>