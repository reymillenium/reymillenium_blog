<?php

    include_once 'app/config.inc.php';
    include_once CONNECTION_URL;

    include_once USER_REPOSITORY_URL;

    include_once STRING_UTILITIES_URL;

    class UserLoginValidator {

        // Inicio y fin del código html de la caja de mostrar errores 
        private $notice_begin;
        private $notice_end;


        # Campos a validar
        private $user_email;
        private $user_password;


        # * Errores *
        private $error_user_email = '';
        private $error_user_password = '';

        public function __construct($connection, $user_email, $user_password) {

            // Se conforma el Inicio y fin del código html de la caja de mostrar errores (debajo de cada imput) 
            $this -> notice_begin = "<br><div class='alert alert-danger col-md-10' role='alert'>";
            $this -> notice_end = "</div>";

            // Se guardan los valores recibidos en los campos de la clase UserLoginValidator
            $this -> user_email = $user_email;
            $this -> user_password = $user_password;

            // Se validan los campos de la clase y se almacena el error correspondiente a cada uno de ellos
            $this -> error_user_email = $this -> validate_user_email($connection, $user_email);
            $this -> error_user_password = $this -> validate_user_password($connection, $user_password, $user_email);

        }

        // Validaciones de campos
        function validate_user_email($connection, $user_email) {

            if (!StringUtilities::started_variable($user_email))
            { // Si no está iniciada o está vacía...
                return 'Debe escribir el email para poder ingresar a su cuenta';
            }
            else if (!strlen($user_email) >= 6)
            { // Si el email no es mayor o igual que 6 caracteres...
                return 'El email debe tener un largo de al menos 6 caracteres';
            }
            else if (!substr_count($user_email, "@") == 1)
            { // Si el email no posee una sola @ (arroba)...
                return 'El email debe tener una @ (arroba)';
            }
            else if (substr($user_email, 0, 1) == "@")
            { // Si el email comienza con una @ (arroba)...
                return 'El email no puede comenzar con una @ (arroba)';
            }
            else if (substr($user_email, strlen($user_email) - 1, 1) == "@")
            { // Si el email tiene una @ (arroba) al final...
                return 'El email no puede terminar con una @ (arroba)';
            }
            else if (strstr($user_email, "'"))
            { // Si el email posee al menos una comilla simple...
                return 'El email no puede contener comillas simples';
            }
            else if (strstr($user_email, "\""))
            { // Si el email posee \...
                return 'El email no puede contener el caracter de barra invertida "\"';
            }
            else if (strstr($user_email, "\\"))
            { // Si el email posee \\...
                return 'El email no puede poseer una doble barra invertida';
            }
            else if (strstr($user_email, "\$"))
            { // Si el email posee \$...
                return 'El email no puede poseer los caracteres \$';
            }
            else if (strstr($user_email, " "))
            { // Si el email posee espacios...
                return 'El email no puede poseer espacios en blanco';
            }
            else if (!substr_count($user_email, ".") >= 1)
            { // Si no tiene al menos un punto...
                return 'El email debe tener al menos un punto';
            }
            else if ((strstr($user_email, ".@")) || (strstr($user_email, "@.")))
            { // Si el email posee un punto y una arroba juntas (sin importar el orden)
                return 'El email no puede tener un punto y un arroba juntos';
            }
            else
            {
                //obtengo la terminacion del dominio
                $term_dom = substr(strrchr($user_email, '.'), 1);

                if (!strlen($term_dom) > 1)
                { // Si el largo de la terminación del dominio no posee más de un caracter...
                    return 'La terminación del dominio del email debe poseer más de un caracter';
                }
                else if (!(strlen($term_dom) < 5))
                { // Si la terminación del dominio del email posee más de 5 caracteres...
                    return 'La extensión del email debe tener menos de 5 caracteres, y ' . $term_dom . ' tiene ' . strlen($term_dom);
                }
                else if (strstr($term_dom, "@"))
                { // Si la terminación del dominio del email posee una @ (arroba)...
                    return 'La terminación del dominio del email no puede contener una @ (arroba)';
                }
                else
                {
                    //compruebo que lo de antes del dominio sea correcto...
                    $antes_dom = substr($user_email, 0, strlen($user_email) - strlen($term_dom));
                    $caracter_ult = substr($antes_dom, strlen($antes_dom) - 1, 1);

                    if ($caracter_ult == "@")
                    { // Si el último caracter de la parte anterior a la terminación del dominio del email posee una arroba
                        return 'La @ (arroba) del email está mal posicionada';
                    }
                    else if ($caracter_ult != ".")
                    { // Si el email no posee un punto antes del dominio final
                        return 'El email no posee un punto antes de la extensión';
                    }
                    else if (!UserRepository::user_exist_by_email($connection, $user_email))
                    { // Si no existe un usuario con el mismo email...
                        return 'No existe un usuario con ese email. <a href="#">Recuperar email</a>';
                    }
                    else
                    { // Todo OK
                        // $this -> user_email = $user_email;
                        return '';
                    }
                }
            }

        }

        function validate_user_password($connection, $user_password, $user_email) {

            if (!StringUtilities::started_variable($user_password))
            { // Si no está definido el password...
                return 'Debe teclear una contraseña para poder acceder a su cuenta';
            }
            else
            {
                if (UserRepository::user_exist_by_email($connection, $user_email))
                { // Si buscando por el email y el usuario existe...
                    // Creamos entonces un usuario temporal...
                    $temp_user = UserRepository::get_user_by_email($connection, $user_email);

                    // Y comparamos las contraseñas simples
                    // if ($temp_user -> get_user_password() != $user_password)
                    // Comparamos con las contraseñas encriptadas
                    if (!password_verify($user_password, $temp_user -> get_user_password()))
                    { // Si no coinciden las contraseñas...
                        return 'La contraseña no es la correcta. <a href="#">Recuperar contraseña</a>';
                    }
                    else
                    { // Pero si conciden = Todo OK
                        return '';
                    }
                }
            }

        }

        // Getters de campos
        public function get_user_email() {

            return $this -> user_email;

        }

        public function get_user_password() {
            return $this -> user_password;

        }

        // * Getters de errores de campos *
        public function get_error_user_email() {

            return $this -> error_user_email;

        }

        public function get_error_user_password() {

            return $this -> error_user_password;

        }

        // Métodos para mostrar el valor de cada campo en 'user_registration_validated' y no tener que volverlos a teclear
        public function show_user_email() {

            if ($this -> user_email !== '') // Si el usuario ya pulsó 'Login' y se almacenó en el validador...
            {
                echo 'value="' . $this -> user_email . '"';
            }

        }

        public function show_user_password() {

            if ($this -> user_password !== '') // Si el usuario ya pulsó 'Login' y se almacenó en el validador...
            {
                echo 'value="' . $this -> user_password . '"';
            }

        }

        // Métodos para mostrar el error debajo de cada input
        public function show_error_user_email() {
            if ($this -> error_user_email !== '') // Si el email tiene algún error...
            {
                // Usamos un componente de Bootstrap que es perfecto para lanzar mensajes de errores
                echo $this -> notice_begin . $this -> error_user_email . $this -> notice_end;
            }

        }

        public function show_error_user_password() {
            if ($this -> error_user_password !== '') // Si el password tiene algún error...
            {
                // Usamos un componente de Bootstrap que es perfecto para lanzar mensajes de errores
                echo $this -> notice_begin . $this -> error_user_password . $this -> notice_end;
            }
            else
            {
                echo '';
            }

        }

        public function is_valid_user_login() {

            // Verificamos que no haya ni un solo error...
            if (($this -> error_user_email == '') && ($this -> error_user_password == ''))
            { // Si no hay errores...
                return true;
            }
            else
            {
                return false;
            }

        }

    }

?>