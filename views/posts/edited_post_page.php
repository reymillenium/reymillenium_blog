<?php

    include 'app/config.inc.php';
    include_once CONNECTION_URL;

    include_once POST_CLASS_URL;
    include_once POST_REPOSITORY_URL;
    include_once EDITED_POST_VALIDATOR_URL;

    include_once SESSION_CONTROL_URL;
    include_once REDIRECTION_URL;

    // Defino algunas variables utilitarias
    $line_break = '<br>';
    $page_title = 'Edición de Entrada';

    // Abro la conexión
    Connection::open_connection();

    // Verifico si se ha pulsado el botón de Guardar la Entrada (submit) en el formulario de Editar Entrada validada
    if (isset($_POST['save_post']))
    { // Si el usuario pulsón el botón de Guardar Entrada dentro del formulario...
        #
        // Guardamos el post_id
        $post_id = $_POST['post_id'];

        // Guardamos los antiguos campos del Post editado
        $initial_post_title = $_POST['initial_post_title'];
        $initial_post_url = $_POST['initial_post_url'];
        $initial_post_text = $_POST['initial_post_text'];
        $initial_post_is_active = $_POST['initial_post_is_active'];
        #
        // Guardamos los nuevos campos del Post editado
        $new_post_title = $_POST['post_title'];
        $new_post_url = $_POST['post_url'];
        $new_post_text = $_POST['post_text'];
        //$post_is_active = isset($_POST['post_is_active']) ? $_POST['post_is_active'] == 'true' ? 1 : 0 : 0; // posible
        $new_post_is_active = isset($_POST['post_is_active']) ? 1 : 0;

        // Creo un validador de Entrada Editada
        $edited_post_validator = new EditedPostValidator(Connection::get_connection(), $new_post_title, $new_post_url, htmlspecialchars($new_post_text), $new_post_is_active, $initial_post_title, $initial_post_url, $initial_post_text, $initial_post_is_active);

        // Ahora verifico si hubo cambios
        if ($edited_post_validator -> were_changes_made())
        { // Si hubo cambios...
            #
            // Entonces verifico si no hay ni un solo error...
            if ($edited_post_validator -> is_valid_edited_post())
            { // Si no hubo errores...
                #
                // Inicio sesión para que no me de explote
                session_start();

                // Creamos la nueva Entrada (Post) a actualizar
                //$new_post = new Post('', $_SESSION['user_id'], $new_post_validator -> get_post_title(), $new_post_validator -> get_post_url(), htmlspecialchars($new_post_validator -> get_post_text()), $_POST['post_is_active'] == 'true' ? 1 : 0, '');
                $new_post = new Post($post_id, $_SESSION['user_id'], $edited_post_validator -> get_post_title(), $edited_post_validator -> get_post_url(), $edited_post_validator -> get_post_text(), $edited_post_validator -> get_post_is_active(), '');

                // Intentamos actualizar la nueva Entrada (Post) en la base de datos
                $the_post_was_updated = PostRepository::update_post(Connection::get_connection(), $new_post);

                if ($the_post_was_updated)
                {  // Si la Entrada (Post) fue actualizada exitosamente...
                    // Redirigimos hacia la página de Entradas (Posts) y que así pueda ver la recién actualizada
                    Redirection::redirect(MANAGER_PAGE_POSTS_URL);
                }
                else
                {
                    echo $line_break . 'No se pudo actualizar la entrada' . $line_break;
                    //echo '<script language="javascript" type= "text/javascript">alertify.alert("Lo sentimos ' . $_SESSION['user_firstname'] . ', ' . $line_break . 'no se pudo insertar su entrada en la Base de Datos");</script>';
                }
            }
        }
        else
        { //Pero si no hubo cambios...
            #
            // Redirecciono a la página del Gestor de Posts sin actualizar nada en lo absoluto
            Redirection::redirect(MANAGER_PAGE_POSTS_URL);
        }
    }

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
    #
    #
    #
    
    // Verifico si se ha pulsado el botón de Editar la Entrada Inicial (submit) en el Gestor de Posts...
    if (isset($_POST['edit_post']))
    { // Si el usuario pulsón el botón de Editar la Entrada dentro del pequeño formulario en el Gestor de Posts...
        // Recuperamos el post_id del Post
        $post_id = $_POST['edited_post_id'];

        // Abrimos la conexión
        Connection::open_connection();

        // Recuperamos el Post a partir de su post_id
        $initial_post = PostRepository::get_post_by_id(Connection::get_connection(), $post_id);

        // Cerramos la conexión
        Connection::close_connection();
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
                        Edición de entrada
                    </h3>
                </div>

                <!-- Card Body BEGIN -->
                <div class="card-body">

                    <div class="container">

                        <!-- New Post Form Begin -->
                        <form role="form" class="form-horizontal texto_destacado" name="formEditPost" method="POST"  action="<?php echo EDITED_POST_PAGE_URL; ?>">
                            <?php

                                // Verifico si es la 1ra vez que se accede a esta página o no
                                if (isset($_POST['edit_post']))
                                { // Si el usuario pulsó el botón de Editar la Entrada (pequeño submit) en la página Gestor de Posts... (1ra vez)
                                    // Muestro el formulario de Editar Post inicial
                                    include_once EDITED_POST_INITIAL_FORM_URL;
                                }
                                else
                                { // Esta no es la primera vez que se accede a esta página
                                    #
                                    // Verifico que se haya accedido a esta página tras pulsar el boton de Guardar la Entrada
                                    if (isset($_POST['save_post']))
                                    {
                                        // Muestro el formulario de Editar Post validado
                                        include_once EDITED_POST_VALIDATED_FORM_URL;
                                    }
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
