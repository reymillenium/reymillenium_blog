<?php

    include_once 'app/config.inc.php';
    include_once CONNECTION_URL;

    include_once USER_CLASS_URL;
    include_once PASSWORD_RECOVERY_CLASS_URL;

    include_once USER_REPOSITORY_URL;
    include_once PASSWORD_RECOVERY_REPOSITORY_URL;

    include_once REDIRECTION_URL;


    // Verificamos si llegamos a esta página pulsando e botón de Enviar Email
    if (isset($_POST['send_email']))
    {
        // Recuperamos el email
        $user_email = $_POST['user_email'];

        // Abrimos la conexión con la BD
        Connection::open_connection();

        // Comprobamos si existe el email en la BD
        if (UserRepository::user_exist_by_email(Connection::get_connection(), $user_email))
        { // Si existe el email
            // Recuperamos el usuario a partir de su user_email
            $user = UserRepository::get_user_by_email(Connection::get_connection(), $user_email);

            // Verificamos si existe o no una petición de recuperación a nombre de ese usuario
            if (!PasswordRecoveryRepository:: password_recovery_exist_by_user_id(Connection::get_connection(), $user -> get_user_id()))
            { // Si no existe un password_recovery...
                // Obtenemos el first_name del usuario
                $user_firstname = $user -> get_user_firstname();

                // Obtenemos un string aleatorio
                $random_string = create_random_string(10);

                // Generamos una url secreta e inconfundible para este usuario, sometiendo la cadena a un hash de 64 caracteres
                $secret_url = hash('sha256', $random_string . $user_firstname, $data);

                // Creamos el password-recovery a insertar en la BD
                $new_password_recovery = new PasswordRecovery('', $user -> get_user_id(), $secret_url, '');

                // Genero la petición para que esto se registre en la BD
                $the_password_recovery_was_inserted = PasswordRecoveryRepository::insert_password_recovery(Connection::get_connection(), $new_password_recovery);

                // Verificamos si se insertó correctamente o no en la BD
                if ($the_password_recovery_was_inserted)
                { // Si fue insertado correctamente...
                    // Redirigimos al index por el momento
                    Redirection::redirect(SERVER_URL);

                    // Notificar instrucciones
                }
                else
                {
                    // Notificar error?? No lo creo!!
                }
            }
            else
            { // Si ya existe un password_recovery para ese user_id...
                // Ignoramos la petición nueva
                return;
            }
        }
        else
        {
            return;
            // Notificar error?? No lo creo!!
        }

        // Cerramos la Conexión con la BD
        Connection::close_connection();
    }
    else
    {
        
    }



    ###############################################
    #    ******  Funciones Utilitarias  ******    #
    ###############################################

    function create_random_string($string_length) {

        $sample_string = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        // Determinamos cuántos caracteres hay en la mustra de caracteres
        $sample_string_length = strlen($sample_string);

        // Creamos el string aleatorio y lo dejamos en blanco por ahora
        $random_string = '';

        // Creamos nuestro string aleatorio
        for ($i = 0; $i < $string_length; $i++) {
            $random_string .= $sample_string[rand(0, $sample_string_length - 1)];
        }

        return $random_string;

    }

    function create_random_word($word_length) {
        $sample_letters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        // Determinamos cuántos números hay en la muestra de números
        $sample_letters_length = strlen($sample_letters);

        // Creamos el string aleatorio y lo dejamos en blanco por ahora
        $random_word = '';

        // Creamos nuestro string aleatorio
        for ($i = 0; $i < $word_length; $i++) {
            $random_word .= $sample_letters[rand(0, $sample_letters_length - 1)];
        }

        return $random_word;

    }

    function create_random_number($number_length) {
        $sample_numbers = '1234567890';

        // Determinamos cuántos números hay en la muestra de números
        $sample_numbers_length = strlen($sample_numbers);

        // Creamos el string aleatorio y lo dejamos en blanco por ahora
        $random_number = '';

        // Creamos nuestro string aleatorio
        for ($i = 0; $i < $number_length; $i++) {
            $random_number .= $sample_numbers[rand(0, $sample_numbers_length - 1)];
        }

        return $random_number;

    }

    function create_random_gender() {

        $sample_genders = ['Female', 'Male', 'Freak'];

        // Determinamos cuántos números hay en la muestra de números
        $sample_genders_length = count($sample_genders);

        // Creamos la variable para el gender aleatorio y lo dejamos en blanco por ahora
        $random_gender = '';

        // Creamos nuestro gender aleatorio
        $random_gender .= $sample_genders[rand(0, $sample_genders_length - 1)];

        return $random_gender;

    }

    function create_random_kind() {

        $sample_kinds = ['Administrator', 'Operator', 'Guest'];

        // Determinamos cuántos números hay en la muestra de números
        $sample_kinds_length = count($sample_kinds);

        // Creamos la variable para el gender aleatorio y lo dejamos en blanco por ahora
        $random_kind = '';

        // Creamos nuestro gender aleatorio
        $random_kind .= $sample_kinds[rand(0, $sample_kinds_length - 1)];

        return $random_kind;

    }

    function create_lorem_ipsum_5_paragraphs() {
        $loren_ipsum_string = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus sit amet purus semper, varius velit a, facilisis ex. Ut aliquet erat quis dictum ullamcorper. Praesent ultricies fringilla libero ac lacinia. Fusce egestas est a tristique venenatis. Morbi lacinia mattis bibendum. Morbi ac pulvinar nisl. Nunc bibendum mauris non libero accumsan, in fringilla eros iaculis. Quisque vitae ullamcorper tellus. Mauris vulputate aliquam erat id iaculis. Mauris velit erat, scelerisque sed ex eget, commodo suscipit diam. Curabitur tristique ligula nulla, et dapibus neque lobortis at. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Mauris orci arcu, vestibulum ac blandit nec, tempus quis nulla. Praesent risus nisi, ornare eget ligula in, consequat luctus felis. Curabitur viverra et augue at scelerisque. Donec tristique justo eu nunc ultrices sollicitudin.

Maecenas et tincidunt tortor. Aenean lobortis sit amet erat vehicula consequat. Duis ac gravida est. Donec cursus dapibus dolor a convallis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut dapibus eros et libero venenatis, nec aliquet felis elementum. Nam finibus ex eget ligula pretium, ut cursus orci placerat. Pellentesque ac lorem ligula. Fusce in metus vel arcu tempus volutpat vitae id enim. Quisque commodo condimentum sapien quis placerat. Nulla egestas, magna nec vestibulum mollis, sem sapien elementum lorem, in vulputate nisl erat ut nisl. Ut volutpat, lectus sit amet condimentum lobortis, leo elit fermentum lorem, sed vehicula neque lacus sed tortor.

Nam tincidunt pretium elit, et scelerisque justo varius sed. Vestibulum non vulputate orci, mattis pharetra elit. Suspendisse vehicula lacinia posuere. Mauris sit amet nisi elit. Aenean pretium lobortis blandit. Nulla bibendum a ligula at dapibus. Donec euismod, dolor sit amet aliquam laoreet, nulla eros auctor leo, a blandit enim erat id arcu. In rhoncus, urna non accumsan sagittis, enim arcu mollis tellus, id hendrerit metus magna non nunc.

In eu condimentum est. Maecenas aliquam in felis in congue. Nulla sollicitudin, nulla in iaculis tincidunt, nulla risus pharetra odio, sed molestie nibh nunc nec nibh. Morbi et nulla non massa rutrum vehicula sed eu dolor. Suspendisse hendrerit lectus nec blandit accumsan. Nam tincidunt vehicula dolor, ac lobortis nisi feugiat eget. Aliquam mattis nisi sodales quam facilisis, a dictum dolor tempor.

Praesent ac auctor lectus. Phasellus ut ligula tortor. Aenean sit amet enim dolor. Proin nec mollis massa. Quisque tempor, lorem nec ullamcorper ullamcorper, ligula lorem placerat ligula, sed placerat ipsum diam non urna. Suspendisse eget turpis enim. Etiam imperdiet commodo gravida.';

        return $loren_ipsum_string;

    }

//      Pueden haber 2 errores:
//      Error de límite de tiempo
//      Error de límite de memoria (128 Mb x objeto?? No cambiarlo)
    
    