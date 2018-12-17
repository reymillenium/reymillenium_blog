<?php

    include 'app/config.inc.php';
    include_once CONNECTION_URL;

    include_once USER_REPOSITORY_URL;

    include_once STRING_UTILITIES_URL;

    class RewritePasswordValidator {

        // Inicio y fin del código html de la caja de mostrar errores 
        private $notice_begin;
        private $notice_end;

        # Campos a validar
        private $user_password1;
        private $user_password2;

        # * Errores *
        private $error_user_password1 = '';
        private $error_user_password2 = '';

        public function __construct($user_password1, $user_password2) {

            // Se conforma el Inicio y fin del código html de la caja de mostrar errores (debajo de cada imput) 
            $this -> notice_begin = "<br><div class='alert alert-danger' role='alert'>";
            $this -> notice_end = "</div>";

            // Se guardan los valores recibidos en los campos de la clase RewritePasswordValidator
            $this -> user_password1 = $user_password1;
            $this -> user_password2 = $user_password2;

            // Se validan los campos de la clase y se almacena el error correspondiente a cada uno de ellos
            $this -> error_user_password1 = $this -> validate_user_password1($user_password1);
            $this -> error_user_password2 = $this -> validate_user_password2($user_password1, $user_password2);

        }

        // Validaciones de campos
        function validate_user_password1($user_password1) {

            if (!StringUtilities::started_variable($user_password1))
            { // Si no está definido el password 1...
                return 'Debe definir una nueva contraseña';
            }
            else
            { // Todo OK
                return '';
            }

        }

        function validate_user_password2($user_password1, $user_password2) {

            if (!StringUtilities::started_variable($user_password2))
            { // Si el usuario no repitió la contraseña...
                return 'Debe repetir la nueva contraseña';
            }
            else if ($user_password1 != $user_password2)
            { // Si las contraseñas no coinciden...
                return 'Las contraseñas no coinciden';
            }
            else
            { // Todo OK
                return '';
            }

        }

        // Getters de campos
        public function get_user_password() {
            return $this -> user_password1;

        }

        // * Getters de errores de campos *
        public function get_error_user_password1() {

            return $this -> error_user_password1;

        }

        public function get_error_user_password2() {

            return $this -> error_user_password2;

        }

        // Métodos para mostrar el valor de cada campo en 'rewrite_password_validated_form' y no tener que volverlos a teclear
        public function show_user_password1() {

            if ($this -> user_password1 !== '') // Si el usuario ya pulsó 'Registrar' y se almacenó en el validador...
            {
                echo 'value="' . $this -> user_password1 . '"';
            }

        }

        public function show_user_password2() {

            if ($this -> user_password2 !== '') // Si el usuario ya pulsó 'Registrar' y se almacenó en el validador...
            {
                echo 'value="' . $this -> user_password2 . '"';
            }

        }

        // Métodos para mostrar el error debajo de cada input
        public function show_error_user_password1() {
            if ($this -> error_user_password1 !== '') // Si el password # 1 tiene algún error...
            {
                // Usamos un componente de Bootstrap que es perfecto para lanzar mensajes de errores
                echo $this -> notice_begin . $this -> error_user_password1 . $this -> notice_end;
            }

        }

        public function show_error_user_password2() {
            if ($this -> error_user_password2 !== '') // Si el password # 2 tiene algún error...
            {
                // Usamos un componente de Bootstrap que es perfecto para lanzar mensajes de errores
                echo $this -> notice_begin . $this -> error_user_password2 . $this -> notice_end;
            }

        }

        // Verificación de validez        
        public function is_valid_rewrite_password() {

            // Verificamos que no haya ni un solo error...
            return (($this -> error_user_password1 == '') && ($this -> error_user_password2 == '')) ? true : false;

        }

    }

?>
