<?php

    include_once 'app/config.inc.php';
    include_once CONNECTION_URL;

    include_once POST_REPOSITORY_URL;
    
    include_once STRING_UTILITIES_URL;

    abstract class PostValidator {

        // Inicio y fin del código html de la caja de mostrar errores 
        protected $notice_begin;
        protected $notice_end;

        # Campos a validar
        protected $post_title;
        protected $post_url;
        protected $post_text;
        protected $post_is_active;
        #
        # * Errores *
        protected $error_post_title = '';
        protected $error_post_url = '';
        protected $error_post_text = '';

        function __construct() {
            
        }

        // Validaciones de campos
        protected function validate_post_title($connection, $post_title) {

            if (!StringUtilities::started_variable($post_title))
            { // Si no está iniciada o está vacía la variable $post_title...
                return 'Debes escribir un título para la entrada';
            }
            else if (strlen($post_title) < 10)
            { // Si el post_title no posee más de 10 caracteres...
                return 'El título debe ser de al menos 10 caracteres';
            }
            else if (strlen($post_title) > 255)
            { // Si el post_title nombre posee más de 255 caracteres...
                return 'El título de la entrada no puede ocupar más de 255 caracteres';
            }
            else if (PostRepository::post_exist_by_title($connection, $post_title))
            { // Si existe una Entrada con ese título...
                return 'Ya existe en la BD una entrada con ese título.';
            }
            else
            { // Todo OK
                return '';
            }

        }

        protected function validate_post_url($connection, $post_url) {

            if (!StringUtilities::started_variable($post_url))
            { // Si no está iniciada o está vacía la variable $post_url...
                return 'Debes escribir una url para la entrada';
            }
            else if (strlen($post_url) < 10)
            { // Si el post_url no posee más de 10 caracteres...
                return 'La url de la entrada debe ser de al menos 10 caracteres';
            }
            else if (strlen($post_url) > 255)
            { // Si la post_url posee más de 255 caracteres...
                return 'La url de la entrada no puede ocupar más de 255 caracteres';
            }
            else if (!StringUtilities::no_spaces_premium($post_url))
            { // Si el post_url tiene al menos un espacio en blanco...
                return 'La url de la entrada no puede tener espacios en blanco';
            }
            else if (PostRepository::post_exist_by_url($connection, $post_url))
            { // Si existe una url igual en la BD...
                return 'Ya existe en la BD una entrada con una url igual';
            }
            else
            { // Todo OK
                return '';
            }

        }

        protected function validate_post_text($post_text) {

            if (!StringUtilities::started_variable($post_text))
            { // Si no está iniciada o está vacía la variable $post_text...
                return 'Debes escribir un texto para la entrada';
            }
            else if (strlen($post_text) < 10)
            { // Si el post_text no posee más de 10 caracteres...
                return 'El texto de la entrada debe ser de al menos 10 caracteres';
            }
            else if (strlen(trim($post_text)) == 0)
            { // Si el Post posee tan solo espacios vacíos...
                return 'El texto de la entrada no puede estar conformado tan solo de espacios vacíos';
            }
            else if (strlen($post_text) > 65535)
            { // Si el post_text posee más de 65 535 caracteres (TEXT)...
                return 'El texto de la entrada no puede ocupar más de 65 535 caracteres';
            }
            else
            { // Todo OK
                return '';
            }

        }

        // Getters de campos
        public function get_post_title() {

            return $this -> post_title;

        }

        public function get_post_url() {

            return $this -> post_url;

        }

        public function get_post_text() {

            return $this -> post_text;

        }

        public function get_post_is_active() {

            return $this -> post_is_active;

        }

        // * Getters de errores de campos *
        public function get_error_post_title() {

            return $this -> error_post_title;

        }

        public function get_error_post_url() {

            return $this -> error_post_url;

        }

        public function get_error_post_text() {

            return $this -> error_post_text;

        }

        // Métodos para mostrar el valor de cada campo en el formulario 'new_post_validated' y no tener que volverlos a teclear
        public function show_post_title() {

            if ($this -> post_title !== '') // Si el usuario ya pulsó 'Guardar Entrada' y se almacenó en el validador...
            {
                echo 'value="' . $this -> post_title . '"';
            }

        }

        public function show_post_url() {

            if ($this -> post_url !== '') // Si el usuario ya pulsó 'Guardar Entrada' y se almacenó en el validador...
            {
                echo 'value="' . $this -> post_url . '"';
            }

        }

        public function show_post_text() {

            if ($this -> post_text !== '') // Si el usuario ya pulsó 'Guardar Entrada' y se almacenó en el validador...
            {
                //echo 'value="' . $this -> post_text . '"';
                echo $this -> post_text;
            }

        }

        // Metodos para colocar la propiedad focused en el lugar idóneo
        public function show_focused_post_title() {

            if ($this -> error_post_title !== '') // Si existe un error relacionado con el título del título del Post...
            {
                echo ' autofocus';
            }
            else
            {
                echo '';
            }

        }

        public function show_focused_post_url() {

            if (($this -> error_post_title == '') && ($this -> error_post_url !== '')) // Si existe un error relacionado con la url del Post...
            {
                echo ' autofocus';
            }
            else
            {
                echo '';
            }

        }

        public function show_focused_post_text() {

            if (($this -> error_post_title == '') && ($this -> error_post_url == '') && ($this -> error_post_text !== '')) // Si existe un error relacionado con el text del Post...
            {
                echo ' autofocus';
            }
            else
            {
                echo '';
            }

        }

        public function show_checked_post_is_active() {

            if ($this -> post_is_active !== '')
            { // Si el suario presió el botón de 'Guardar Post' y se almacenó en el validador...
                echo ($this -> post_is_active == 1 ? ' checked' : '');
            }

        }

        // Métodos para mostrar el error debajo de cada input
        public function show_error_post_title() {
            if ($this -> error_post_title !== '') // Si el post_title tiene algún error...
            {
                // Usamos un componente de Bootstrap que es perfecto para lanzar mensajes de errores
                echo $this -> notice_begin . $this -> error_post_title . $this -> notice_end;
            }

        }

        public function show_error_post_url() {
            if ($this -> error_post_url !== '') // Si el post_url tiene algún error...
            {
                // Usamos un componente de Bootstrap que es perfecto para lanzar mensajes de errores
                echo $this -> notice_begin . $this -> error_post_url . $this -> notice_end;
            }

        }

        public function show_error_post_text() {
            if ($this -> error_post_text !== '') // Si el post_text tiene algún error...
            {
                // Usamos un componente de Bootstrap que es perfecto para lanzar mensajes de errores
                echo $this -> notice_begin . $this -> error_post_text . $this -> notice_end;
            }

        }

        public function is_valid_post() {

            // Verificamos que no haya ni un solo error...
            if (($this -> error_post_title) == '' && ($this -> error_post_url == '') && ($this -> error_post_text == ''))
            { // Si no hay errores...
                return true;
            }
            else
            { // Si hay algún error...
                return false;
            }

        }

    }
    