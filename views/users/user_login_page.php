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
    $page_title = 'Entrada al Sistema';

    // Cargo la declaración de mi página web
    include_once PAGE_HEAD_DECLARATION_URL;

    // Abro la conexión
    Connection::open_connection();

    // Antes que nada verifico si el usuario ya inició una sesión
    if ((!SessionControl::is_the_session_started()))
    { // Si la sesión no ha sido iniciada... 
        //echo '<script language="javascript" type= "text/javascript">alertify.alert("Aviso al usuario:", "Usted no ha iniciado la sesión. Adelante, entre al sistema!");</script>';
        // Verifico si se ha pulsado el botón de Login (submit) en el formulario de Login del usuario
        if (isset($_POST['login']))
        { // Si el usuario pulsón el botón de Login dentro del formulario...
            // Creo un validador de login
            $login_validator = new UserLoginValidator(Connection::get_connection(), $_POST['user_email'], $_POST['user_password']);

            // Verifico si no hay ni un solo error en el login...
            if ($login_validator -> is_valid_user_login())
            {
                // Creamos entonces un usuario temporal...
                $temp_user = UserRepository::get_user_by_email(Connection::get_connection(), $login_validator -> get_user_email());

                //Abrimos sesión para loa datos del usuario
                SessionControl::start_session($temp_user -> get_user_id(), $temp_user -> get_user_firstname(), $temp_user -> get_user_secondname(), $temp_user -> get_user_lastname(), $temp_user -> get_user_email(), $temp_user -> get_user_password(), $temp_user -> get_user_phone(), $temp_user -> get_user_gender(), $temp_user -> get_user_is_active(), $temp_user -> get_user_kind(), $temp_user -> get_user_creation_date(), $temp_user -> get_user_image());

                // Redirecciono hacia la página personal del usuario
                Redirection::redirect(SERVER_URL);
            }
        }
    }
    else
    { // Si ya fué iniciada la sesión antes...
        // Sacamos al usuario de esta página, redirigiéndolo hacia index.php
        Redirection::redirect(SERVER_URL);
    }

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
                        Entrada al sistema
                    </h4>
                </div>

                <!-- Card Body BEGIN -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-1">
                        </div>

                        <div class="col-md-10">

                            <!-- Login Form Begin -->
                            <form role="form" class="" method="POST" name="formularioContactoPOST" action="<?php echo USER_LOGIN_PAGE_URL ?>">

                                <?php

                                    // Antes que nada verifico si el usuario ya inició una sesión
//                                    if (!SessionControl::is_the_session_started())
//                                    { // Si la sesión no ha sido iniciada... 
//                                        if (isset($_POST['login']))
//                                        { // Si el usuario pulsó el botón de login dentro del formulario...
//                                            // Muestro el formulario de login validado
//                                            include_once USER_LOGIN_VALIDATED_FORM_URL;
//                                        }
//                                        else // El usuario recién acaba de entrar a la página de login... (no pulsó el botón de Login)
//                                        {
//                                            // Muestro el formulario de Login vacío
//                                            include_once USER_LOGIN_EMPTY_FORM_URL;
//                                        }
//                                    }

                                    if (isset($_POST['login']))
                                    { // Si el usuario pulsó el botón de login dentro del formulario...
                                        // Muestro el formulario de login validado
                                        include_once USER_LOGIN_VALIDATED_FORM_URL;
                                    }
                                    else // El usuario recién acaba de entrar a la página de login... (no pulsó el botón de Login)
                                    {
                                        // Muestro el formulario de Login vacío
                                        include_once USER_LOGIN_EMPTY_FORM_URL;
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