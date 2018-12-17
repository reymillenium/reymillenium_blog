<?php

    include 'app/config.inc.php';
    //include_once 'app/Connection.inc.php';
    include_once CONNECTION_URL;

    // Defino algunas variables utilitarias
    $line_break = '<br>';
    $page_title = 'Favoritos del Blog';

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
            <div class="card">

                <div class="card-header">
                    <!--<span class="fa fa-clock" aria-hidden="true"></span>-->
                    <i class="fa fa-clock-o fa-1x" aria-hidden="true"></i>

                    Últimas entradas
                </div>

                <div class="card-body">


                    <?php

                        // include_once 'app/Connection.inc.php';
                        // Connection::open_connection();
                        // Connection::close_connection();

                    ?>
                    <p style="text-align: justify;">
                        Todavía no hay entradas que mostrar. Todavía no hay entradas que mostrar. Todavía no 
                        hay entradas que mostrar. Todavía no hay entradas que mostrar. Todavía no hay entradas 
                        que mostrar. Todavía no hay entradas que mostrar.  
                    </p>

                </div>

                <div class="card-footer">
                    <?php include_once WEB_SITE_COPYRIGHT_INFO; ?>
                </div>

            </div>

            <br><br><br>

        </div>

    </div>
</div>
<!-- Main Content Container End -->

<?php include_once PAGE_FOOTER_URL; ?>