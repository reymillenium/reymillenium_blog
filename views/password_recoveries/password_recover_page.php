<?php

    include_once 'app/config.inc.php';
    include_once CONNECTION_URL;
    
    include_once USER_CLASS_URL;
    include_once USER_REPOSITORY_URL;
    include_once USER_LOGIN_VALIDATOR_URL;
    
    include_once REDIRECTION_URL;
    include_once SESSION_CONTROL_URL;

    // Defino algunas variables utilitarias
    $line_break = '<br>';
    $page_title = 'Recuperación de Contraseña';

    // Cargo la declaración de mi página web
    include_once PAGE_HEAD_DECLARATION_URL;

    // Abro la conexión
//    Connection::open_connection();
    

    // Cargo el encabezado de la página html
    include_once PAGE_HEADER_URL;

?>
<!-- Main Content Container Begin -->
<div class="container">
    <div class="row">

        <div class="col-md-3"></div>

        <!-- Center Column BEGIN -->
        <div class="col-md-6">

            <!-- Card BEGIN -->
            <div class="card">

                <div class="card-header">
                    <!--<span class="fa fa-clock" aria-hidden="true"></span>-->
                    <h4 class="card-title">
                        <i class="fa fa-clock-o fa-1x" aria-hidden="true"></i>
                        Recuperación de Contraseña
                    </h4>
                </div>

                <!-- Card Body BEGIN -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-1">
                        </div>

                        <div class="col-md-10">

                            <!-- Login Form Begin -->
                            <form role="form" class="" method="POST" name="formularioContactoPOST" action="<?php echo GENERATE_SECRET_URL_SCRIPT_URL ?>">

                                <?php
                                    
                                    echo "";

                                    if (isset($_POST['send_email']))
                                    { // Si el usuario pulsó el botón de login dentro del formulario...
                                        // Muestro el formulario de Recuperación de Contraseña validado
                                        include_once PASSWORD_RECOVER_VALIDATED_FORM_URL;
                                    }
                                    else // El usuario recién acaba de entrar a la página de login... (no pulsó el botón de Login)
                                    {
                                        // Muestro el formulario de Recuperación de Contraseña vacío
                                        include_once PASSWORD_RECOVER_EMPTY_FORM_URL;
                                    }

                                ?>

                            </form>
                            <!-- Login Form END -->    

                        </div>

                        <div class="col-md-1">
                        </div>

                    </div>

                </div>
                <!-- Card Body END -->


                <div class="container">

                </div>


                <!-- Card Footer BEGIN -->
                <div class="card-footer">
                    <?php include_once WEB_SITE_COPYRIGHT_INFO; ?>
                </div>
                <!-- Card Footer END -->

            </div>
            <!-- Card END -->

        </div>
        <!-- Center Column END -->

        <div class="col-md-3"></div>

    </div>

</div>
<!-- Main Content Container End -->

<?php include_once PAGE_FOOTER_URL; ?>