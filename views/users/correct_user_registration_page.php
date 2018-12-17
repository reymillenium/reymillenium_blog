<?php

    include 'app/config.inc.php';
    include_once CONNECTION_URL;
    
    include_once USER_REPOSITORY_URL;
    
    include_once REDIRECTION_URL;

    // Defino algunas variables utilitarias
    $line_break = '<br>';
    $page_title = 'Registro Correcto';

    // Abro la conexión
    Connection::open_connection();

    // Cargo la declaración de mi página web
    include_once PAGE_HEAD_DECLARATION_URL;

    // Cargo el encabezado de la página html
    include_once PAGE_HEADER_URL;

?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header">
                    <i class="fa fa-check-circle-o fa-2x" aria-hidden="true"></i> Registro Correcto
                </div>

                <div class="card-body text-center">
                    <p>
                        ¡Gracias por registrarte <b><?php echo $user_firstname; ?></b>!
                    </p>
                    <br>

                    <p>
                        <a href="<?php echo USER_LOGIN_PAGE_URL; ?>">Inicie sesión</a> para comenzar a usar su cuenta.

                    </p>

                </div>


            </div>

        </div>

    </div>

</div>

<?php include_once PAGE_FOOTER_URL; ?>