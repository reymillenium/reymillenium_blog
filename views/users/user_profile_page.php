<?php

    // Defino una fecha de caducidad muy antigua
    header("Expires: Fri, 14 Mar 1980 20:53:00 GMT");

    // Especifico que la última vez que se actualizó la página es la fecha y hora actual, ahora que acabamos d ecargar la página
    // Hace que la caché no se ponga en uso, pues está caducada
    header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");

    // Evitamos que el navegador guarde en caché imágenes en el perfil de usuario
//    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0"); //no guardar en CACHE 
//    header("Cache-Control: post-check=0, pre-check=0", false); //no guardar en CACHE 
    header("Cache-Control: no-cache, must-revalidate"); //no guardar en CACHE 
    header("Pragma: no-cache"); //PARANOIA, NO GUARDAR EN CACHE 

    include 'app/config.inc.php';
    include_once CONNECTION_URL;

    include_once USER_CLASS_URL;
    include_once USER_REPOSITORY_URL;
    include_once USER_REGISTRATION_VALIDATOR_URL;

    include_once SESSION_CONTROL_URL;
    include_once REDIRECTION_URL;

    // Defino algunas variables utilitarias
    $line_break = '<br>';
    $page_title = 'Perfil de Usuario';

    // Abro la conexión
    Connection::open_connection();

    //session_start();
    #
    // Cargo la declaración de mi página web
    include_once PAGE_HEAD_DECLARATION_URL;

    // Cargo el encabezado de la página html
    include_once PAGE_HEADER_URL;

    // Verificamos si está iniciada o no la sesión
    if (!SessionControl::is_the_session_started())
    { // Si no está iniciada la sesión...
        #
        // Redirijo al usuario a la página de inicio (Home)
        Redirection::redirect(USER_LOGIN_PAGE_URL);
    }
    else
    { // Si está iniciada la sesión...
        #
        // Recuperamos el user_id del usuario que está en la sesión actual
        $user_id = $_SESSION['user_id'];

        // Recuperamos el user a partir de su user_id
        $initial_user = UserRepository::get_user_by_id(Connection::get_connection(), $user_id);

        // Recuperamos el sexo del user
        $user_gender = $initial_user -> get_user_gender();

        // Verifico ahora si se ha pulsado el botón de Actualizar (submit) en el formulario de Actualización del perfil del usuario
        if (isset($_POST['update_profile']))
        { // Si el usuario pulsón el botón de Actualizar Perfil dentro del formulario...
//            echo 'Se pulsó el botón Actualizar Perfil' . '</br>';
            $the_file_was_uploaded = false;

            #
            // Verifico si selecciono una nueva imagen o no
            if (isset($_FILES['image_file']['tmp_name']))
            { // Si el usuario ha seleccinado una imagen...
//                echo 'Se seleccionó la imagen' . '</br>';
                // Creamos una variable donde especificamos el directorio
                $directory = UPLOAD_DIR_URL;
                $target_folder = $directory . basename($_FILES['image_file']['name']);

                // Definimos la extensión del archivo seleccionado
                $file_extension = pathinfo($target_folder, PATHINFO_EXTENSION);

                // Para una comprobación adicional??? Sale un array con información variada acerca del archivo
                $testing = getimagesize($_FILES['image_file']['tmp_name']);
                #
                // Obtrenemos el tamaño del archivo seleccionado
                $file_size = $_FILES['image_file']['size'];
                #
//                echo '$testing = ' . json_encode($testing). ' and $file_size = ' . $file_size;
                // Verificamos el array con información variada acerca del archivo
                if ($testing !== false)
                {
                    #
//                    echo 'El testing dio verdadero' . '</br>';
                    // Verifico si el archivo seleccionado es mayor que 500 Kb o no
                    if ($file_size <= 500000)
                    { // Si  el archivo seleccionado es menor o igual que 500 Kb...
                        #
//                        echo 'El size es menor que 500 Kb' . '</br>';
                        // Verificamos si el archivo seleccionado tiene o no la extensión adecuada
                        if (($file_extension == 'jpg') || ($file_extension == 'png') || ($file_extension != 'jpeg'))
                        { // Si tiene la extensión adecuada...
                            #
//                            echo 'El archivo tiene una extension adecuada de imagen' . '</br>';
                            // Verifico si se puede subir o no el archivo seleccionado hacia la carpeta
                            if (move_uploaded_file($_FILES['image_file']['tmp_name'], UPLOAD_DIR_URL . $user_id . "." . $file_extension))
                            { // Si se puede subir el archivo seleccionado hacia la carpeta...
                                $the_file_was_uploaded = true;
//                                echo 'Se puede subir el archivo seleccionado hacia la carpeta' . '</br>';
                            }
                            else
                            { // Si no se puede subir el archivo seleccionado hacia la carpeta...
                                echo 'Ha ocurrido un error en la subida del archivo' . '</br>';
                            }
                        }
                        else
                        { // Si no tiene la extensión adecuada...
                            echo 'El archivo debe poseer una extensión ".jpg", ".png" o sino ".jpeg", y en cambio es de tipo ' . $file_extension;
                        }
                    }
                    else
                    { // Si  el archivo seleccionado es mayor que 500 Kb...
                        echo 'El archivo no puede pesar más de 500 Kb';
                    }
                }
            }
            else
            {
                echo 'No se recibió la imagen ';
            }

//            echo $the_file_was_uploaded ? 'El archivo ' . basename($_FILES['image_file']['name']) . ' ha sido subido' : 'No se subió el archivo';
        }

        //Clear cache and check filesize again
//        clearstatcache();
        #
        #// Verificamos si existe una imagen asociado al id del usuario en la carpeta upload
        #
        if (file_exists(UPLOAD_DIR_URL . $user_id . '.jpg'))
        {
            $image_path = CUSTOM_PROFILE_PICS_RELATIVE_DIR_URL . $user_id . ".jpg";
        }
        else if (file_exists(UPLOAD_DIR_URL . $user_id . '.png'))
        {
            $image_path = CUSTOM_PROFILE_PICS_RELATIVE_DIR_URL . $user_id . '.png';
        }
        else if (file_exists(UPLOAD_DIR_URL . $user_id . '.jpeg'))
        {
            $image_path = CUSTOM_PROFILE_PICS_RELATIVE_DIR_URL . $user_id . '.jpeg';
        }
        else
        { // Si no existe una imagen asociada al usuario...
            #
                // Definimos entonces una imagen default del user en base a su sexo
            switch ($user_gender) {
                case "Male":
                    $image_path = DEFAULT_PROFILE_PICS_RELATIVE_DIR_URL . "man_profile_600x600.jpg";
                    break;

                case "Female":
                    $image_path = DEFAULT_PROFILE_PICS_RELATIVE_DIR_URL . "woman_profile_600x600.jpg";
                    break;

                case "Freak":
                    $image_path = DEFAULT_PROFILE_PICS_RELATIVE_DIR_URL . "freak_profile_600x600.png";
                    break;

                default:
                    $image_path = DEFAULT_PROFILE_PICS_RELATIVE_DIR_URL . "man_profile_600x600.jpg";
                    break;
            }
        }
    }

    // Cierro la conexión
    Connection::close_connection();

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
                        Perfil del usuario
                    </h3>
                </div>

                <!-- Card Body BEGIN -->
                <div class="card-body">

                    <!-- Login Form Begin -->
                    <div class="container">
                        <form role="form" class="form-horizontal texto_destacado" method="POST" name="formRegistration" action="<?php echo USER_PROFILE_PAGE_URL ?>" enctype="multipart/form-data">
                            <?php

                                if (isset($_POST['update_profile']))
                                { // Si el usuario pulsó el botón de Actualizar Perfil dentro del formulario...
                                    // Muestro el formulario de perfil validado
                                    include_once USER_PROFILE_VALIDATED_FORM_URL;
                                }
                                else // El usuario recién acaba de entrar a la página de perfil (no pulsó el botón de Actualizar Perfil)
                                {
                                    // Muestro el formulario de perfil inicial
                                    include_once USER_PROFILE_INITIAL_FORM_URL;
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