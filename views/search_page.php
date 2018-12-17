<?php

    include_once 'app/config.inc.php';
    include_once CONNECTION_URL;

    include_once POST_REPOSITORY_URL;
    include_once SEARCH_VALIDATOR_URL;

    include_once STRING_UTILITIES_URL;
    include_once POSTS_WRITER_URL;

    // Defino algunas variables utilitarias
    $line_break = '<br>';
    $page_title = 'Búsqueda en el Blog';

    // Abro la conexión
    Connection::open_connection();

    // Cargo la declaración de mi página web
    include_once PAGE_HEAD_DECLARATION_URL;

    // Cargo el encabezado de la página html
    include_once PAGE_HEADER_URL;

    $search_term = NULL;
    $post_date_order = NULL;
    $fields = array();
    $search_by_title = false;
    $search_by_text = false;
    $search_by_author = false;
    $posts = NULL;

    if (isset($_POST['search']))
    {

        // Recupero el término de búsqueda
        $search_term = $_POST['search_term'];

        // Creo un validador de búsqueda
        $search_validator = new SearchValidator($search_term);

        // Verifico si no hay ni un solo error...
        if ($search_validator -> is_valid_search_term())
        {

            // Recupero el orden en que debo mostrar los posts al usuario (ascendente o descendente)
            if (isset($_POST['post_date_order']))
            {
                $post_date_order = $_POST['post_date_order'];
            }

            // Verifico si está definida el campo por el cual buscar los Posts
            if (isset($_POST['fields']))
            { // Si está definido...
                #
            // Recupero el arreglo con los campos por los cuales buscar los Posts
                $fields = $_POST['fields'];
                //$fields = array($_POST['fields']) ;
                #
            // Recorro el arreglo con los campos por los cuales buscar los Posts 
//                for ($i = 0; $i < sizeof($fields); $i++) {
//
//                    if ($fields[$i] == 'post_title')
//                    {
//                        $search_by_title = true;
//                    }
//
//                    if ($fields[$i] == 'post_text')
//                    {
//                        $search_by_text = true;
//                    }
//
//                    if ($fields[$i] == 'post_author_id')
//                    {
//                        $search_by_author = true;
//                    }
//                }

                $search_by_title = in_array("post_title", $fields) ? true : false;
                $search_by_text = in_array("post_text", $fields) ? true : false;
                $search_by_author = in_array("post_author_id", $fields) ? true : false;
            }

            if ($post_date_order == 'descending')
            {
                //  *** Búsqueda avanzada por 1 campo ***
                if (($search_by_title) && (!$search_by_text) && (!$search_by_author))
                {
                    $posts = PostRepository::get_posts_by_title_ord_by_date_desc(Connection::get_connection(), $search_term);
                }

                if ((!$search_by_title) && ($search_by_text) && (!$search_by_author))
                {
                    $posts = PostRepository::get_posts_by_text_ord_by_date_desc(Connection::get_connection(), $search_term);
                }

                if ((!$search_by_title) && (!$search_by_text) && ($search_by_author))
                {
                    $posts = PostRepository::get_posts_by_author_name_ord_by_date_desc(Connection::get_connection(), $search_term);
                }

                //  *** Búsqueda avanzada por 2 campos ***
                if (($search_by_title) && ($search_by_text) && (!$search_by_author))
                {
                    $posts = PostRepository::get_posts_by_title_and_text_ord_by_date_desc(Connection::get_connection(), $search_term);
                }

                if ((!$search_by_title) && ($search_by_text) && ($search_by_author))
                {
                    $posts = PostRepository::get_posts_by_text_and_author_name_ord_by_date_desc(Connection::get_connection(), $search_term);
                }

                if (($search_by_title) && (!$search_by_text) && ($search_by_author))
                {
                    $posts = PostRepository::get_posts_by_title_and_author_name_ord_by_date_desc(Connection::get_connection(), $search_term);
                }

                //  *** Búsqueda avanzada por 3 campos ***
                if (($search_by_title) && ($search_by_text) && ($search_by_author))
                {
                    $posts = PostRepository::get_posts_by_title_by_text_and_author_name_ord_by_date_desc(Connection::get_connection(), $search_term);
                }
            }
            else if ($post_date_order == 'ascending')
            {
                //  *** Búsqueda avanzada por 1 campo ***
                if (($search_by_title) && (!$search_by_text) && (!$search_by_author))
                {
                    $posts = PostRepository::get_posts_by_title_ord_by_date_asc(Connection::get_connection(), $search_term);
                }

                if ((!$search_by_title) && ($search_by_text) && (!$search_by_author))
                {
                    $posts = PostRepository::get_posts_by_text_ord_by_date_asc(Connection::get_connection(), $search_term);
                }

                if ((!$search_by_title) && (!$search_by_text) && ($search_by_author))
                {
                    $posts = PostRepository::get_posts_by_author_name_ord_by_date_asc(Connection::get_connection(), $search_term);
                }

                //  *** Búsqueda avanzada por 2 campos ***
                if (($search_by_title) && ($search_by_text) && (!$search_by_author))
                {
                    $posts = PostRepository::get_posts_by_title_and_text_ord_by_date_asc(Connection::get_connection(), $search_term);
                }

                if ((!$search_by_title) && ($search_by_text) && ($search_by_author))
                {
                    $posts = PostRepository::get_posts_by_text_and_author_name_ord_by_date_asc(Connection::get_connection(), $search_term);
                }

                if (($search_by_title) && (!$search_by_text) && ($search_by_author))
                {
                    $posts = PostRepository::get_posts_by_title_and_author_name_ord_by_date_asc(Connection::get_connection(), $search_term);
                }

                //  *** Búsqueda avanzada por 3 campos ***
                if (($search_by_title) && ($search_by_text) && ($search_by_author))
                {
                    $posts = PostRepository::get_posts_by_title_by_text_and_author_name_ord_by_date_asc(Connection::get_connection(), $search_term);
                }
            }
        }
    }

?>


<!-- Main Content Container Begin -->
<div class="container-fluid">
    <div class="row">

        <?php include_once PAGE_LEFT_COLUMN_URL; ?>

        <div id="div_right_column" class="col-md-8">

            <div class="row">
                <div class="col-md-12">
                    <div class="card">

                        <div class="card-header">
                            <i class="fa fa-search fa-1x" aria-hidden="true"></i>
                            Resultados de la búsqueda
                        </div>

                        <div class="card-body">
                            <!--<p style="color: black;" class="alert alert-success" role="alert">-->
                            <small>
                                <?php

                                    if (count($posts) == 0)
                                    {

                                        if (StringUtilities::only_spaces($search_term))
                                        {
                                            echo '<p style="color: black;" class="alert alert-danger" role="alert">'
                                            . '<i class="em em-rage"></i>'
                                            . ' &ensp;No son válidas las búsquedas de tan solo espacios en blanco en la BD'
                                            . '</p>';
                                        }
                                        else
                                        {
                                            echo '<p style="color: black;" class="alert alert-danger" role="alert">'
                                            . '<i class="em em-cry"></i>'
                                            . ' &ensp;No se hallaron resultados para: <strong>"' . $search_term . '"</strong>'
                                            . '</p>';
                                        }
                                    }
                                    else if (count($posts) == 1)
                                    {
                                        echo '<p style="color: black;" class="alert alert-success" role="alert">'
                                        . '<i class="em em-sunglasses"></i>'
                                        . ' &ensp;Se halló 1 resultado para: <strong>"' . $search_term . '"</strong>'
                                        . '</p>';
                                    }
                                    else
                                    {
                                        echo '<p style="color: black;" class="alert alert-success" role="alert">'
                                        . '<i class="em em-smiley"></i>'
                                        . ' &ensp;Se hallaron ' . count($posts) . ' resultados para: <strong>"' . $search_term . '"</strong>'
                                        . '</p>';
                                    }

                                ?>
                            </small>
                            <!--</p>-->

                            <?php

                                if (count($posts))
                                {
                                    //print_r($posts);
                                    PostsWriter::write_searched_posts($posts);
                                }

                            ?>



                        </div>

                        <div class="card-footer">
                            <?php include_once WEB_SITE_COPYRIGHT_INFO; ?>
                        </div>

                    </div>
                </div>
            </div>
            <br><br><br>

        </div>

    </div>


</div>
<!-- Main Content Container End -->

<?php include_once PAGE_FOOTER_URL; ?>