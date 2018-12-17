<?php

    class SessionControl {

        public static function start_session($user_id, $user_firstname, $user_secondname, $user_lastname, $user_email, $user_password, $user_phone, $user_gender, $user_is_active, $user_kind, $user_creation_date, $user_image) {

            // Verificamos que no esté iniciada otra sesión
            if (session_id() == '')
            { // Si no está iniciada la sesión para este navegador...
                // Habilitamos espacio en la memoria del servidor para la sesión y la iniciamos
                session_start();
            }

            // Guardamos los datos del usuario en el array global $_SESSION, en forma de una cookie en el servidor
            $_SESSION['user_id'] = $user_id;
            $_SESSION['user_firstname'] = $user_firstname;
            $_SESSION['user_secondname'] = $user_secondname;
            $_SESSION['user_lastname'] = $user_lastname;
            $_SESSION['user_email'] = $user_email;
            $_SESSION['user_password'] = $user_password;
            $_SESSION['user_phone'] = $user_phone;
            $_SESSION['user_gender'] = $user_gender;
            $_SESSION['user_is_active'] = $user_is_active;
            $_SESSION['user_kind'] = $user_kind;
            $_SESSION['user_creation_date'] = $user_creation_date;
            $_SESSION['user_image'] = $user_image;

        }

        public static function close_session() {

            // Verificamos que no esté iniciada otra sesión
            if (session_id() == '')
            { // Si no está iniciada la sesión para este navegador...
                // Habilitamos espacio en la memoria del servidor para la sesión, aunque vayamos a cerrarla luego
                session_start();
            }

            // Verificamos que esté definida una cookie en el servidor para el user_id
            if (isset($_SESSION['user_id']))
            { // Si está definida la cookie para el user_id...
                // Borramos los datos guardados del user_id en las cookies del servidor
                unset($_SESSION['user_id']);
            }

            // Verificamos que esté definida una cookie en el servidor para el user_firstname
            if (isset($_SESSION['user_firstname']))
            { // Si está definida la cookie para el user_firstname...
                // Borramos los datos guardados del user_firstname en las cookies del servidor
                unset($_SESSION['user_firstname']);
            }

            // Verificamos que esté definida una cookie en el servidor para el user_secondname
            if (isset($_SESSION['user_secondname']))
            { // Si está definida la cookie para el user_secondname...
                // Borramos los datos guardados del user_secondname en las cookies del servidor
                unset($_SESSION['user_secondname']);
            }

            // Verificamos que esté definida una cookie en el servidor para el user_lastname
            if (isset($_SESSION['user_lastname']))
            { // Si está definida la cookie para el user_lastname...
                // Borramos los datos guardados del user_lastname en las cookies del servidor
                unset($_SESSION['user_lastname']);
            }

            // Verificamos que esté definida una cookie en el servidor para el user_email
            if (isset($_SESSION['user_email']))
            { // Si está definida la cookie para el user_email...
                // Borramos los datos guardados del user_email en las cookies del servidor
                unset($_SESSION['user_email']);
            }

            // Verificamos que esté definida una cookie en el servidor para el user_password
            if (isset($_SESSION['user_password']))
            { // Si está definida la cookie para el user_password...
                // Borramos los datos guardados del user_password en las cookies del servidor
                unset($_SESSION['user_password']);
            }

            // Verificamos que esté definida una cookie en el servidor para el user_phone
            if (isset($_SESSION['user_phone']))
            { // Si está definida la cookie para el user_phone...
                // Borramos los datos guardados del user_phone en las cookies del servidor
                unset($_SESSION['user_phone']);
            }

            // Verificamos que esté definida una cookie en el servidor para el user_gender
            if (isset($_SESSION['user_gender']))
            { // Si está definida la cookie para el user_gender...
                // Borramos los datos guardados del user_gender en las cookies del servidor
                unset($_SESSION['user_gender']);
            }

            // Verificamos que esté definida una cookie en el servidor para el user_is_active
            if (isset($_SESSION['user_is_active']))
            { // Si está definida la cookie para el user_is_active...
                // Borramos los datos guardados del user_is_active en las cookies del servidor
                unset($_SESSION['user_is_active']);
            }

            // Verificamos que esté definida una cookie en el servidor para el user_kind
            if (isset($_SESSION['user_kind']))
            { // Si está definida la cookie para el user_kind...
                // Borramos los datos guardados del user_kind en las cookies del servidor
                unset($_SESSION['user_kind']);
            }

            // Verificamos que esté definida una cookie en el servidor para el user_creation_date
            if (isset($_SESSION['user_creation_date']))
            { // Si está definida la cookie para el user_creation_date...
                // Borramos los datos guardados del user_creation_date en las cookies del servidor
                unset($_SESSION['user_creation_date']);
            }

            // Verificamos que esté definida una cookie en el servidor para el user_image
            if (isset($_SESSION['user_image']))
            { // Si está definida la cookie para el user_image...
                // Borramos los datos guardados del user_image en las cookies del servidor
                unset($_SESSION['user_image']);
            }

            // Para asegurarnos que todo está bien cerrado, destruimos el espacio en la memoria del servidor para esta sesión
            session_destroy();

        }

        public static function is_the_session_started() {
            // Verificamos que no esté iniciada otra sesión
            if (session_id() == '')
            { // Si no está iniciada la sesión para este navegador...
                // Habilitamos espacio en la memoria del servidor para la sesión
//                 session_start();
            }

            // Verificamos que esté definida una cookie en el servidor para los más útiles campos del usuario
            if ((isset($_SESSION['user_id'])) && (isset($_SESSION['user_firstname'])) && (isset($_SESSION['user_email'])) && (isset($_SESSION['user_phone'])))
            {
                return true;
            }
            else
            {
                return false;
            }

        }

    }
    