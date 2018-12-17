<?php

    include_once 'app/config.inc.php';
    include_once CONNECTION_URL;

    include_once USER_REPOSITORY_URL;
    include_once POSTS_WRITER_URL;

    include_once SESSION_CONTROL_URL;


    // Defino algunas variables utilitarias
    $line_break = '<br>';
    $page_title = 'Blog de Reinier: Inicio';

    // Cargo la declaración de mi página web
    include_once PAGE_HEAD_DECLARATION_URL;

    // Cargo el encabezado de la página html
    include_once PAGE_HEADER_URL;

?>

<!-- Main Content Container Begin -->
<div class="container-fluid">
    <div class="row">

        <?php include_once PAGE_LEFT_COLUMN_URL; ?>

        <div id="div_right_column" class="col-md-8">

            <?php

                // Antes que nada verifico si el usuario ya inició una sesión
                if ((SessionControl::is_the_session_started()))
                { // Si la sesión ha sido iniciada... 
                    #
                    
                    // Escribo todos los posts en la página
//                     PostsWriter::write_all_the_posts();
                    PostsWriter::write_paged_posts(1, 5);
                }

            ?>

        </div>

    </div>
</div>
<!-- Main Content Container End -->

<?php include_once PAGE_FOOTER_URL; ?>