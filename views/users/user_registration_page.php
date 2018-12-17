<?php

    include 'app/config.inc.php';
    include_once CONNECTION_URL;

    include_once USER_CLASS_URL;
    include_once USER_REPOSITORY_URL;
    include_once USER_REGISTRATION_VALIDATOR_URL;

    include_once SESSION_CONTROL_URL;
    include_once REDIRECTION_URL;

    // Defino algunas variables utilitarias
    $line_break = '<br>';
    $page_title = 'Registro de Usuario';

    // Abro la conexión
    Connection::open_connection();

    // Cargo la declaración de mi página web
    include_once PAGE_HEAD_DECLARATION_URL;

    // Verifico si se ha pulsado el botón de Registrar (submit) en el formulario de registro del usuario
    if (isset($_POST['register']))
    { // Si el usuario pulsón el botón de registrar dentro del formulario...
        // Creo un validador
        /* @var $_POST type */
        $validator = new UserRegistrationValidator(Connection::get_connection(), $_POST['user_firstname'], $_POST['user_secondname'], $_POST['user_lastname'], $_POST['user_email'], $_POST['user_password1'], $_POST['user_password2'], $_POST['user_phone'], $_POST['user_gender'], $_POST['user_kind']);

        // Verifico si no hay ni un solo error...
        if ($validator -> is_valid_user_registration())
        {
            session_start();
            
            // Creamos el nuevo usuario a insertar
            $new_user = new User('', $validator -> get_user_firstname(), $validator -> get_user_secondname(), $validator -> get_user_lastname(), $validator -> get_user_email(), password_hash($validator -> get_user_password(), PASSWORD_DEFAULT), $validator -> get_user_phone(), $validator -> get_user_gender(), '', $validator -> get_user_kind(), '', '');

            // Intentamos insertar el nuevo usuario en la base de datos
            $the_user_was_inserted = UserRepository::insert_user(Connection::get_connection(), $new_user);

            if ($the_user_was_inserted)
            {  // Si el usuario fue insertado exitosamente...
                # 
                // Informar al usuario que se ha registrado correctamente.
                //echo '<script language="javascript" type= "text/javascript">alertify.alert("Felicidades ' . $new_user -> get_user_firstname() . ', usted se ha registrado exitosamente");</script>';
                // Redirigimos hacia la página de inicio de sesión para que el usuario pueda usar sus datos recién creados para entrar en la parte privada de nuestro blog
                //Redirection::redirect(CORRECT_USER_REGISTRATION_PAGE_URL . '?user_firstname=' . $new_user -> get_user_firstname());
                #
                // redirecciono en dependencia de si está registrándose un usuario externo o alguine ya loggeado
                if (SessionControl::is_the_session_started())
                { // Fue creado el usuario por alguien ya loggeado
                    #
                    // Redirecciono hacia la plantilla de Gestión de Usuarios
                    Redirection::redirect(MANAGER_PAGE_USERS_URL);
                }
                else
                { // El usuario fue creado por alguine no loggeado aun
                    // redirecciono hacia la página de registro correcto
                    Redirection::redirect(CORRECT_USER_REGISTRATION_PAGE_URL . '/' . $new_user -> get_user_firstname());
                }
            }
            else
            {
                // echo $line_break . 'No se pudo insertar el usuario' . $line_break;
                echo '<script language="javascript" type= "text/javascript">alertify.alert("Lo sentimos ' . $new_user -> get_user_firstname() . ', ' . $line_break . 'no se le pudo insertar en la Base de Datos");</script>';
            }
        }
    }

    // Cierro la conexión
    Connection::close_connection();

    // Cargo el encabezado de la página html
    include_once PAGE_HEADER_URL;

?>

<!-- Main Content Container Begin -->
<div class="container-fluid">
    <div class="row">

        <?php include_once PAGE_LEFT_COLUMN_URL; ?>

        <!-- Right Column BEGIN -->
        <div id="div_right_column" class="col-md-8">

            <!-- Card BEGIN -->
            <div class="card">

                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fa fa-user-secret fa-1x" aria-hidden="true"></i>
                        Introduce tus datos
                    </h3>
                </div>

                <!-- Card Body BEGIN -->
                <div class="card-body">

                    <!-- Login Form Begin -->
                    <div class="container">
                        <form role="form" class="form-horizontal texto_destacado" method="POST" name="formRegistration" action="<?php echo USER_REGISTRATION_PAGE_URL ?>">
                            <?php

                                if (isset($_POST['register']))
                                { // Si el usuario pulsó el botón de registrar dentro del formulario...
                                    // Muestro el formulario de registro validado
                                    include_once USER_REGISTRATION_VALIDATED_FORM_URL;
                                }
                                else // El usuario recién acaba de entrar a la página de registro (no pulsó el botón de Registrar)
                                {
                                    // Muestro el formulario de registro vacío
                                    include_once USER_REGISTRATION_EMPTY_FORM_URL;
                                }

                            ?>

                        </form>
                    </div>
                    <!-- Login Form END -->  

                </div>
                <!-- Card Body END -->

                <!-- Card Footer BEGIN -->
                <div class="card-footer">
                    <?php include_once WEB_SITE_COPYRIGHT_INFO; ?>
                </div>
                <!-- Card Footer END -->

            </div>
            <!-- Card END -->

            <br><br><br>

        </div>
        <!-- Right Column END -->

    </div>

</div>
<!-- Main Content Container End -->

<?php include_once PAGE_FOOTER_URL; ?>
