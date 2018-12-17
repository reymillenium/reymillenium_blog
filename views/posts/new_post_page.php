<?php

    include 'app/config.inc.php';
    include_once CONNECTION_URL;
    
    include_once POST_CLASS_URL;
    include_once POST_REPOSITORY_URL;
    include_once NEW_POST_VALIDATOR_URL;
    
    include_once SESSION_CONTROL_URL;
    include_once REDIRECTION_URL;

    // Defino algunas variables utilitarias
    $line_break = '<br>';
    $page_title = 'Nueva Entrada';

    // Abro la conexión
    Connection::open_connection();

    // Cargo la declaración de mi página web
    include_once PAGE_HEAD_DECLARATION_URL;

//    // Verifico primero si se ha iniciado sesión
//    if (SessionControl::is_the_session_started())
//    { // Si se inició la sesión...
//        // Muestro toda la página
//    }
//    else
//    { // Pero si no se ha iniciado sesión...
//        // Saco al usuario de la página
//    }
    // Verifico si se ha pulsado el botón de Guardar la Entrada (submit) en el formulario de Creación de Nueva Entrada
    if (isset($_POST['save_post']))
    { // Si el usuario pulsón el botón de Guardar Entrada dentro del formulario...
        //$post_is_active = isset($_POST['post_is_active']) ? $_POST['post_is_active'] == 'true' ? 1 : 0 : 0; // posible
        $post_is_active = isset($_POST['post_is_active']) ? 1 : 0;

        // Creo un validador de Nueva Entrada
        $new_post_validator = new NewPostValidator(Connection::get_connection(), $_POST['post_title'], $_POST['post_url'], htmlspecialchars($_POST['post_text']), $post_is_active);

        // Verifico si no hay ni un solo error...
        if ($new_post_validator -> is_valid_new_post())
        {
            // Inicio sesión para que no me de explote
            session_start();

            // Creamos la nueva Entrada (Post) a insertar
            //$new_post = new Post('', $_SESSION['user_id'], $new_post_validator -> get_post_title(), $new_post_validator -> get_post_url(), htmlspecialchars($new_post_validator -> get_post_text()), $_POST['post_is_active'] == 'true' ? 1 : 0, '');
            $new_post = new Post('', $_SESSION['user_id'], $new_post_validator -> get_post_title(), $new_post_validator -> get_post_url(), htmlspecialchars($new_post_validator -> get_post_text()), $post_is_active, '');

            // Intentamos insertar la nueva Entrada (Post) en la base de datos
            $the_post_was_inserted = PostRepository::insert_post(Connection::get_connection(), $new_post);

            if ($the_post_was_inserted)
            {  // Si la Entrada (Post) fue insertada exitosamente...
                // Redirigimos hacia la página de Entradas (Posts) y sí pueda ver la recién creada
                Redirection::redirect(MANAGER_PAGE_POSTS_URL);
            }
            else
            {
                // echo $line_break . 'No se pudo insertar el usuario' . $line_break;
                echo '<script language="javascript" type= "text/javascript">alertify.alert("Lo sentimos ' . $_SESSION['user_firstname'] . ', ' . $line_break . 'no se pudo insertar su entrada en la Base de Datos");</script>';
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

            <div class="card">

                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fa fa-edit fa-1x" aria-hidden="true"></i>
                        Crear una nueva entrada
                    </h3>
                </div>

                <!-- Card Body BEGIN -->
                <div class="card-body">

                    <div class="container">

                        <!-- New Post Form Begin -->
                        <form role="form" class="form-horizontal texto_destacado" name="formNewPost" method="POST"  action="<?php echo NEW_POST_PAGE_URL; ?>">
                            <?php

                                if (isset($_POST['save_post']))
                                { // Si el usuario pulsó el botón de guardar el post dentro del formulario...
                                    // Muestro el formulario de Nuevo Post validado
                                    include_once NEW_POST_VALIDATED_FORM_URL;
                                }
                                else // El usuario recién acaba de entrar a la página de nuevo post (no pulsó el botón de Guardar Post)
                                {
                                    // Muestro el formulario de Nuevo Post vacío
                                    include_once NEW_POST_EMPTY_FORM_URL;
                                }

                            ?>

                        </form>
                        <!-- New Post Form END -->

                    </div>
                    <!-- Container END -->

                </div>
                <!-- Card Body END -->

                <!-- Card Footer BEGIN -->
                <div class="card-footer">
                    <?php include_once WEB_SITE_COPYRIGHT_INFO; ?>
                </div>
                <!-- Card Footer END -->

            </div>
            <!-- Card END -->

        </div>
        <!-- Right Column END -->

    </div>

</div>
<!-- Main Content Container End -->

<?php include_once PAGE_FOOTER_URL; ?>
