<?php

    include_once 'app/config.inc.php';
    include_once CONNECTION_URL;

    include_once USER_REPOSITORY_URL;

    include_once STRING_UTILITIES_URL;

    class UserRegistrationValidator {

        // Inicio y fin del código html de la caja de mostrar errores 
        private $notice_begin;
        private $notice_end;

        # Campos a validar
        private $user_firstname;
        private $user_secondname;
        private $user_lastname;
        private $user_email;
        private $user_password1;
        private $user_password2;
        private $user_phone;
        private $user_gender;
        // private $user_is_active;
        private $user_kind;
        // private $user_creation_date;
        // private $user_image;
        #
        
        
        # * Errores *
        private $error_user_firstname = '';
        private $error_user_secondname = '';
        private $error_user_lastname = '';
        private $error_user_email = '';
        private $error_user_password1 = '';
        private $error_user_password2 = '';
        private $error_user_phone = '';
        private $error_user_gender = '';
        // private $error_user_is_active = '';
        private $error_user_kind = '';

        // private $error_user_creation_date = '';
        // private $error_user_image = '';

        public function __construct($connection, $user_firstname, $user_secondname, $user_lastname, $user_email, $user_password1, $user_password2, $user_phone, $user_gender, $user_kind) {

            // Se conforma el Inicio y fin del código html de la caja de mostrar errores (debajo de cada imput) 
            $this -> notice_begin = "<br><div class='alert alert-danger' role='alert'>";
            $this -> notice_end = "</div>";

            // Se guardan los valores recibidos en los campos de la clase UserRegistrationValidator
            $this -> user_firstname = $user_firstname;
            $this -> user_secondname = $user_secondname;
            $this -> user_lastname = $user_lastname;
            $this -> user_email = $user_email;
            $this -> user_password1 = $user_password1;
            $this -> user_password2 = $user_password2;

            $this -> user_phone = $user_phone;
            $this -> user_gender = $user_gender;
            $this -> user_kind = $user_kind;

            // Se validan los campos de la clase y se almacena el error correspondiente a cada uno de ellos
            $this -> error_user_firstname = $this -> validate_user_firstname($user_firstname);
            $this -> error_user_secondname = $this -> validate_user_secondname($user_secondname);
            $this -> error_user_lastname = $this -> validate_user_lastname($user_lastname);
            $this -> error_user_email = $this -> validate_user_email($connection, $user_email);

            $this -> error_user_password1 = $this -> validate_user_password1($user_password1);
            $this -> error_user_password2 = $this -> validate_user_password2($user_password1, $user_password2);

            $this -> error_user_phone = $this -> validate_user_phone($connection, $user_phone);
            $this -> error_user_gender = $this -> validate_user_gender($user_gender);
            $this -> error_user_kind = $this -> validate_user_kind($user_kind);

        }

        // Validaciones de campos
        private function validate_user_firstname($user_firstname) {

            if (!StringUtilities::started_variable($user_firstname))
            { // Si no está iniciada o está vacía...
                return 'Debes escribir un nombre de usuario';
            }
            else if (!StringUtilities::only_letters_and_accents($user_firstname))
            { // Si el primer nombre posee números o caracteres especiales...
                return 'El nombre no puede contener números o caracteres especiales';
            }
            else if (strlen($user_firstname) < 3)
            { // Si el primer nombre no posee más de dos caracteres...
                return 'El nombre debe ser de al menos 3 caracteres';
            }
            else if (strlen($user_firstname) > 255)
            { // Si el primer nombre posee más de 255 caracteres...
                return 'El nombre no puede ocupar más de 255 caracteres';
            }
            else
            { // Todo OK
                // $this -> user_firstname = $user_firstname;
                return '';
            }

            // $this -> user_firstname = $user_firstname;

        }

        private function validate_user_secondname($user_secondname) {

            if (StringUtilities::started_variable($user_secondname))
            { // Si el segundo nombre es introducido...
                if (!StringUtilities::only_letters_and_accents($user_secondname))
                { // Si el segundo nombre posee carcatres especiales o números...
                    return 'El segundo nombre no puede poseer números ni caracteres especiales';
                }
                else
                { // Todo OK. Si el segundo nombre definido es un nombre normal...
                    $this -> user_secondname = $user_secondname;
                    return '';
                }
            }
            else
            { // Si el segundo nombre no está incluido y/o definido. Todo OK
                // $this -> user_secondname = '';
                return '';
            }

        }

        private function validate_user_lastname($user_lastname) {

            if (!StringUtilities::started_variable($user_lastname)) // Si no está iniciada o está vacía...
            {
                return 'Debes escribir los apellidos';
            }
            else if (strlen($user_lastname) < 2)
            {
                return 'El apellido debe ser mayor que 2 caracteres';
            }
            else if (strlen($user_lastname) > 255)
            {
                return 'El apellido no puede ocupar más de 255 caracteres';
            }
            else if (!StringUtilities::only_letters_and_accents($user_lastname))
            { // Si el apellido posee números o caracteres especiales...
                return 'El apellido no puede contener números o caracteres especiales';
            }
            else
            { // Todo OK
                // $this -> user_lastname = $user_lastname;
                return '';
            }

        }

        function validate_user_email($connection, $user_email) {

            if (!StringUtilities::started_variable($user_email))
            { // Si no está iniciada o está vacía...
                return 'Debes escribir el email';
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
                    else if (UserRepository::user_exist_by_email($connection, $user_email))
                    { // Si existe un usuario con el mismo email...
                        return 'Ya existe un usuario con el mismo email. <a href="#">Recuperar password</a>';
                    }
                    else
                    { // Todo OK
                        // $this -> user_email = $user_email;
                        return '';
                    }
                }
            }

        }

        function validate_user_password1($user_password1) {

            if (!StringUtilities::started_variable($user_password1))
            { // Si no está definido el password 1...
                return 'Debe definir una contraseña para su cuenta';
            }
            else
            { // Todo OK
                return '';
            }

        }

        function validate_user_password2($user_password1, $user_password2) {

            if (!StringUtilities::started_variable($user_password2))
            { // Si el usuario no repitió la contraseña...
                return 'Debe repetir la contraseña';
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

        function validate_user_phone($connection, $user_phone) {

            if (!StringUtilities::started_variable($user_phone))
            { // Si el phone no ha sido inicializado o definido...
                return 'Debes escribir un teléfono';
            }
            else if (strlen($user_phone) != 10)
            { // Si el phone no tiene la cantidad de dígitos adecuada (10)...
                return 'El teléfono debe incluir el area regional. Son 10 dígitos en total.';
            }
            else if (!is_numeric($user_phone))
            { // Si el teléfono no tiene solo números...
                return 'El teléfono solo puede contener números';
            }
            else if (UserRepository::user_exist_by_phone($connection, $user_phone))
            { // Si existe un usuario con el mismo teléfono...
                return 'Ya existe un usuario con el mismo teléfono';
            }
            else
            { // Todo OK
                // $this -> user_phone = $user_phone;
                return '';
            }

        }

        function validate_user_gender($user_gender) {
            if (!StringUtilities::started_variable($user_gender))
            { // No está definido el género (sexo)...
                return 'Debe elegir el género';
            }
            else if (($user_gender != 'Female') && ($user_gender != 'Male') && ($user_gender != 'Freak'))
            { // Si el usuario no escoge un sexo...
                return 'Debe elegir uno de los géneros existentes';
            }
            else
            { // Todo OK
                // $this -> user_gender = $user_gender;
                return '';
            }

        }

        function validate_user_kind($user_kind) {

            if (!StringUtilities::started_variable($user_kind))
            { // No está definido el tipo de cuenta...
                return 'Debe elegir el tipo de cuenta';
            }
            else if (($user_kind != 'Administrator') && ($user_kind != 'Operator') && ($user_kind != 'Guest'))
            { // Si el usuario no escoge un tipo de cuenta de entre los existentes...
                return 'Debe elegir uno de los tipos de cuentas existentes';
            }
            else
            { // Todo OK
                // $this -> user_kind = $user_kind;
                return '';
            }

        }

        // Getters de campos

        public function get_user_firstname() {

            return $this -> user_firstname;

        }

        public function get_user_secondname() {

            return $this -> user_secondname;

        }

        public function get_user_lastname() {

            return $this -> user_lastname;

        }

        public function get_user_email() {

            return $this -> user_email;

        }

        public function get_user_password() {
            return $this -> user_password1;

        }

        public function get_user_phone() {

            return $this -> user_phone;

        }

        public function get_user_gender() {

            return $this -> user_gender;

        }

        // public function get_user_is_active() { return $this -> is_active; }

        public function get_user_kind() {

            return $this -> user_kind;

        }

        // public function get_user_creation_date() { return $this -> created_at; }
        #
        // public function get_user_image() { return $this -> user_image; }
        #

        
        // * Getters de errores de campos *
        public function get_error_user_firstname() {

            return $this -> error_user_firstname;

        }

        public function get_error_user_secondname() {

            return $this -> error_user_secondname;

        }

        public function get_error_user_lastname() {

            return $this -> error_user_lastname;

        }

        public function get_error_user_email() {

            return $this -> error_user_email;

        }

        public function get_error_user_password1() {

            return $this -> error_user_password1;

        }

        public function get_error_user_password2() {

            return $this -> error_user_password2;

        }

        public function get_error_user_phone() {

            return $this -> error_user_phone;

        }

        public function get_error_user_gender() {

            return $this -> error_user_gender;

        }

        // public function get_error_user_is_active() { return $this -> error_user_is_active; }

        public function get_error_user_kind() {

            return $this -> error_user_kind;

        }

        // public function get_error_user_creation_date() { return $this -> error_user_creation_date; }
        #
        // public function get_error_user_image() { return $this -> error_user_image; }
        #

        
        // Métodos para mostrar el valor de cada campo en 'user_registration_validated' y no tener que volverlos a teclear
        public function show_user_firstname() {

            if ($this -> user_firstname !== '') // Si el usuario ya pulsó 'Registrar' y se almacenó en el validador...
            {
                echo 'value="' . $this -> user_firstname . '"';
            }

        }

        public function show_user_secondname() {

            if ($this -> user_secondname !== '') // Si el usuario ya pulsó 'Registrar' y se almacenó en el validador...
            {
                echo 'value="' . $this -> user_secondname . '"';
            }

        }

        public function show_user_lastname() {

            if ($this -> user_lastname !== '') // Si el usuario ya pulsó 'Registrar' y se almacenó en el validador...
            {
                echo 'value="' . $this -> user_lastname . '"';
            }

        }

        public function show_user_email() {

            if ($this -> user_email !== '') // Si el usuario ya pulsó 'Registrar' y se almacenó en el validador...
            {
                echo 'value="' . $this -> user_email . '"';
            }

        }

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

        public function show_user_phone() {

            if ($this -> user_phone !== '') // Si el usuario ya pulsó 'Registrar' y se almacenó en el validador...
            {
                echo 'value="' . $this -> user_phone . '"';
            }

        }

        public function show_user_gender_female() {

            if ($this -> user_gender !== '') // Si el usuario ya pulsó 'Registrar' y se almacenó en el validador...
            {
                // echo 'value="' . $this -> user_gender . '"';

                if ($this -> user_gender == 'Female')
                {
                    echo ' selected="true"';
                }
                else
                {
                    // echo ' selected="false"';
                    echo '';
                }
            }

        }

        public function show_user_gender_male() {

            if ($this -> user_gender !== '') // Si el usuario ya pulsó 'Registrar' y se almacenó en el validador...
            {
                // echo 'value="' . $this -> user_gender . '"';

                if ($this -> user_gender == 'Male')
                {
                    echo ' selected="true"';
                }
                else
                {
                    // echo ' selected="false"';
                    echo '';
                }
            }

        }

        public function show_user_gender_freak() {

            if ($this -> user_gender !== '') // Si el usuario ya pulsó 'Registrar' y se almacenó en el validador...
            {
                // echo 'value="' . $this -> user_gender . '"';

                if ($this -> user_gender == 'Freak')
                {
                    echo ' selected="true"';
                }
                else
                {
                    // echo ' selected="false"';
                    echo '';
                }
            }

        }

        public function show_user_kind_administrator() {

            if ($this -> user_kind !== '') // Si el usuario ya pulsó 'Registrar' y se almacenó en el validador...
            {
                // echo 'value="' . $this -> user_kind . '"';

                if ($this -> user_kind == 'Administrator')
                {
                    echo ' selected="true"';
                }
                else
                {
                    echo '';
                }
            }

        }

        public function show_user_kind_operator() {

            if ($this -> user_kind !== '') // Si el usuario ya pulsó 'Registrar' y se almacenó en el validador...
            {
                // echo 'value="' . $this -> user_kind . '"';

                if ($this -> user_kind == 'Operator')
                {
                    echo ' selected="true"';
                }
                else
                {
                    echo '';
                }
            }

        }

        public function show_user_kind_guest() {

            if ($this -> user_kind !== '') // Si el usuario ya pulsó 'Registrar' y se almacenó en el validador...
            {
                // echo 'value="' . $this -> user_kind . '"';

                if ($this -> user_kind == 'Guest')
                {
                    echo ' selected="true"';
                }
                else
                {
                    echo '';
                }
            }

        }

        // Métodos para mostrar el error debajo de cada input
        public function show_error_user_firstname() {
            if ($this -> error_user_firstname !== '') // Si el firstname tiene algún error...
            {
                // Usamos un componente de Bootstrap que es perfecto para lanzar mensajes de errores
                echo $this -> notice_begin . $this -> error_user_firstname . $this -> notice_end;
            }

        }

        public function show_error_user_secondname() {
            if ($this -> error_user_secondname !== '') // Si el secondname tiene algún error...
            {
                // Usamos un componente de Bootstrap que es perfecto para lanzar mensajes de errores
                echo $this -> notice_begin . $this -> error_user_secondname . $this -> notice_end;
            }

        }

        public function show_error_user_lastname() {
            if ($this -> error_user_lastname !== '') // Si el lastname tiene algún error...
            {
                // Usamos un componente de Bootstrap que es perfecto para lanzar mensajes de errores
                echo $this -> notice_begin . $this -> error_user_lastname . $this -> notice_end;
            }

        }

        public function show_error_user_email() {
            if ($this -> error_user_email !== '') // Si el email tiene algún error...
            {
                // Usamos un componente de Bootstrap que es perfecto para lanzar mensajes de errores
                echo $this -> notice_begin . $this -> error_user_email . $this -> notice_end;
            }

        }

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

        public function show_error_user_phone() {
            if ($this -> error_user_phone !== '') // Si el phone tiene algún error...
            {
                // Usamos un componente de Bootstrap que es perfecto para lanzar mensajes de errores
                echo $this -> notice_begin . $this -> error_user_phone . $this -> notice_end;
            }

        }

        public function show_error_user_gender() {
            if ($this -> error_user_gender !== '') // Si el gender tiene algún error...
            {
                // Usamos un componente de Bootstrap que es perfecto para lanzar mensajes de errores
                echo $this -> notice_begin . $this -> error_user_gender . $this -> notice_end;
            }

        }

        public function show_error_user_kind() {
            if ($this -> error_user_kind !== '') // Si el kind tiene algún error...
            {
                // Usamos un componente de Bootstrap que es perfecto para lanzar mensajes de errores
                echo $this -> notice_begin . $this -> error_user_kind . $this -> notice_end;
            }

        }

        public function is_valid_user_registration() {

            // Verificamos que no haya ni un solo error...
            if (($this -> error_user_firstname) == '' && ($this -> error_user_secondname == '') && ($this -> error_user_lastname == '') && ($this -> error_user_email == '') && ($this -> error_user_password1 == '') && ($this -> error_user_password2 == '') && ($this -> error_user_phone == '') && ($this -> error_user_gender == '') && ($this -> error_user_kind == ''))
            { // Si no hay errores...
                return true;
            }
            else
            {
                return false;
            }

        }

    }

