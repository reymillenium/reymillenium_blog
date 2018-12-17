<?php

    include 'app/config.inc.php';
    include_once CONNECTION_URL;

    include_once SEARCH_VALIDATOR_URL;

    include_once STRING_UTILITIES_URL;

    class SearchValidator {

        // Inicio y fin del código html de la caja de mostrar errores 
        private $notice_begin;
        private $notice_end;

        # Campos a validar
        private $search_term;

        # * Errores *
        private $error_search_term = '';

        public function __construct($search_term) {

            // Se conforma el Inicio y fin del código html de la caja de mostrar errores (debajo de cada imput) 
            $this -> notice_begin = "<br><div class='alert alert-danger' role='alert'>";
            $this -> notice_end = "</div>";

            // Se guardan los valores recibidos en los campos de la clase SearchValidator
            $this -> search_term = $search_term;

            // Se validan los campos de la clase y se almacena el error correspondiente a cada uno de ellos
            $this -> error_search_term = $this -> validate_search_term($search_term);

        }

        // Validaciones de campos
        function validate_search_term($search_term) {

            if (!StringUtilities::started_variable($search_term))
            { // Si no está definido el search_term...
                return 'Debe definir un término de búsqueda';
            }
            else if (StringUtilities::only_spaces($search_term))
            {
                return 'No puede teclear tan solo espacios en blanco';
            }
            else
            { // Todo OK
                return '';
            }

        }

        // Getters de campos
        public function get_search_term() {
            return $this -> search_term;

        }

        // * Getters de errores de campos *
        public function get_error_search_term() {

            return $this -> error_search_term;

        }

        // Métodos para mostrar el valor de cada campo en 'search_validated_form' y no tener que volverlos a teclear
        public function show_search_term() {

            if ($this -> search_term !== '') // Si el usuario ya pulsó 'Buscar' y se almacenó en el validador...
            {
                echo 'value="' . $this -> search_term . '"';
            }

        }

        // Metodos para colocar la propiedad focused en el lugar idóneo
        public function show_focused_search_term() {

            if ($this -> error_search_term !== '') // Si existe un error relacionado con el search_term...
            {
                echo ' autofocus';
            }
            else
            {
                echo '';
            }

        }

        // Métodos para mostrar el error debajo de cada input
        public function show_error_search_term() {
            if ($this -> error_search_term !== '') // Si el search_term tiene algún error...
            {
                // Usamos un componente de Bootstrap que es perfecto para lanzar mensajes de errores
                echo $this -> notice_begin . $this -> error_search_term . $this -> notice_end;
            }

        }

        // Metodos para colocar la propiedad checked en el lugar idóneo
        public function show_checked_post_title($fields) {

            // Declaro una variable para la salida
            $checked = '';

            // Recorro el arreglo con los campos por los cuales buscar los Posts 
            for ($i = 0; $i < sizeof($fields); $i++) {

                if ($fields[$i] == 'post_title')
                {
                    $checked = ' checked';
                }
            }

            return $checked;

        }

        public function show_checked_post_text($fields) {

            // Declaro una variable para la salida
            $checked = '';

            // Recorro el arreglo con los campos por los cuales buscar los Posts 
            for ($i = 0; $i < sizeof($fields); $i++) {

                if ($fields[$i] == 'post_text')
                {
                    $checked = ' checked';
                }
            }

            return $checked;

        }

        public function show_checked_post_author_id($fields) {

            // Declaro una variable para la salida
            $checked = '';

            // Recorro el arreglo con los campos por los cuales buscar los Posts 
            for ($i = 0; $i < sizeof($fields); $i++) {

                if ($fields[$i] == 'post_author_id')
                {
                    $checked = ' checked';
                }
            }

            return $checked;

        }

        public function show_checked_descending($post_date_order) {

            return ($post_date_order == 'descending' ? ' checked' : '');

        }

        public function show_checked_ascending($post_date_order) {

            return ($post_date_order == 'ascending' ? ' checked' : '');

        }

        // Verificación de validez        
        public function is_valid_search_term() {

            // Verificamos que no haya ni un solo error...
            return ($this -> error_search_term == '') ? true : false;

        }

    }

?>
