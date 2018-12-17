<?php

    include 'app/config.inc.php';
    include_once CONNECTION_URL;

    include_once USER_REPOSITORY_URL;
    include_once PASSWORD_RECOVERY_REPOSITORY_URL;

    include_once REDIRECTION_URL;

    // Abrimos una conexión con la BD
    Connection::open_connection();

    if (PasswordRecoveryRepository::password_recovery_exist_by_secret_url(Connection::get_connection(), $personal_url))
    {
        $user_id = PasswordRecoveryRepository::get_user_id_by_password_recovery_secret_url(Connection::get_connection(), $personal_url);
    }
    else
    {
        // Lanzar ERROR 404
        echo '404';
    }

    // Verifico si el usuario pulsón el botón de Cambiar contraseña o no, en el formulario
    if (isset($_POST['change_password']))
    { // Si pulsón el botón de Canbiar contraseña en el formulario...
        #
        // Recupererar los campos necesarios
        $user_id = $_POST['user_id'];
        $user_password_1 = $_POST['user_password_1'];
        $user_password_2 = $_POST['user_password_2'];

        include_once REWRITE_PASSWORD_VALIDATOR_URL;

        // Creo un validador de Reescritura de Password
        $rewrite_password_validator = new RewritePasswordValidator($user_password_1, $user_password_2);

        // Verifico que no haya ni un solo error
        if ($rewrite_password_validator -> is_valid_rewrite_password())
        { // Si no hubo errores...
            #
            // Inicio sesión para que no me de explote
            session_start();

            // *** Iniciar transacción ***
            #
            // Cifro la contraseña
            $new_encrypted_password = password_hash($user_password_1, PASSWORD_DEFAULT);

            // Obtengo la conexión
            $connection = Connection::get_connection();

            try {

                // Inicio el registro de las transacciones a realizar en el Registro Secundario del Servidor
                $connection -> beginTransaction();

                #***************************************************************************************************
                #                               Realizo la Operación # 1                    
                #***************************************************************************************************
                #
                 // Intentamos actualizar la contraseña en la BD
                $the_user_password_was_updated = UserRepository::update_user_password_by_id($connection, $user_id, $new_encrypted_password);
                #
                #***************************************************************************************************
                #                              Realizo la Operación # 2                    
                #***************************************************************************************************
                #
                // Elimino la password_recovery de la BD
                #
                $the_password_recovery_was_deleted = PasswordRecoveryRepository::delete_password_recovery_by_user_id($connection, $user_id);

                // Confirmamos las operaciones que hayamos echo
                $connection -> commit();
                #
            } catch (PDOException $exc) {

                // echo $exc -> getTraceAsString();
                print 'ERROR: ' . $exc -> getMessage() . "<br>";

                // Deshago las operaciones realizadas, porque ocurrrió un error
                $connection -> rollBack();
            }

            // Verifico si la actualización del password fue exitosa o no
            if ($the_user_password_was_updated)
            {  // Si el password fue actualizado exitosamente...
                #        
                // Mostramos una página informativa sobre el éxito de la actualización del password
                #
                // Temporal: Redirigimos hacia la página de login, y así pueda entrar con su nueva contraseña
                Redirection::redirect(USER_LOGIN_PAGE_URL);
                #
            }
            else
            {
                echo $line_break . 'No se pudo actualizar la contraseña' . $line_break;
                //echo '<script language="javascript" type= "text/javascript">alertify.alert("Lo sentimos, no se pudo cambiar su contraseña en la BD.");</script>';
            }
        }
    }


    // Cerramos la conexión con la BD
    //Connection::close_connection();
    // Defino algunas variables utilitarias
    $line_break = '<br>';
    $page_title = 'Reescritura de la Contraseña';

    // Cargo la declaración de mi página web
    include_once PAGE_HEAD_DECLARATION_URL;

    // Abro la conexión
    //Connection::open_connection();
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
                        Cambio de contraseña
                    </h4>
                </div>

                <!-- Card Body BEGIN -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-1">
                        </div>

                        <div class="col-md-10">

                            <!-- Login Form Begin -->
                            <form role="form" class="" method="POST" name="form_change_password" action="<?php echo REWRITE_PASSWORD_PAGE_URL . "/" . $personal_url; ?>">

                                <?php

                                    if (isset($_POST['change_password']))
                                    { // Si el usuario pulsó el botón de Reescribir dentro del formulario...
                                        // Muestro el formulario de Reescribir Contraseña validado
                                        include_once REWRITE_PASSWORD_VALIDATED_FORM_URL;
                                    }
                                    else
                                    { // El usuario recién acaba de entrar a la página de login (no pulsó el botón de Reescribir)
                                        // Muestro el formulario de Reescribir Contraseña vacío
                                        include_once REWRITE_PASSWORD_EMPTY_FORM_URL;
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