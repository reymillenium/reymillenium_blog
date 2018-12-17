<?php

    include_once 'app/config.inc.php';
    include_once CONNECTION_URL;

    include_once POST_VALIDATOR_URL;

    class NewPostValidator extends PostValidator {

        public function __construct($connection, $post_title, $post_url, $post_text, $post_is_active) {

            // Se conforma el Inicio y fin del código html de la caja de mostrar errores (debajo de cada imput) 
            $this -> notice_begin = "<br><div class='alert alert-danger' role='alert'>";
            $this -> notice_end = "</div>";

            // Se guardan los valores recibidos en los campos de la clase newPostValidator
            $this -> post_title = $post_title;
            $this -> post_url = $post_url;
            $this -> post_text = $post_text;
            $this -> post_is_active = $post_is_active;

            // Se validan los campos de la clase y se almacena el error correspondiente a cada uno de ellos
            $this -> error_post_title = $this -> validate_post_title($connection, $post_title);
            $this -> error_post_url = $this -> validate_post_url($connection, $post_url);
            $this -> error_post_text = $this -> validate_post_text($post_text);

        }

        public function is_valid_new_post() {

            // Verificamos que no haya ni un solo error...
            return $this -> is_valid_post() ? true : false;

        }

    }

?>
