<?php

    include_once 'app/config.inc.php';
    include_once CONNECTION_URL;
    
    include_once POST_VALIDATOR_URL;

    class EditedPostValidator extends PostValidator {

        private $changes_made;
        #
        private $initial_post_title;
        private $initial_post_url;
        private $initial_post_text;
        private $initial_post_is_active;

        public function __construct($connection, $post_title, $post_url, $post_text, $post_is_active, $initial_post_title, $initial_post_url, $initial_post_text, $initial_post_is_active) {

            // Se conforma el Inicio y fin del código html de la caja de mostrar errores (debajo de cada imput) 
            $this -> notice_begin = "<br><div class='alert alert-danger' role='alert'>";
            $this -> notice_end = "</div>";

            // Se guardan los valores recibidos en los campos de la clase PostValidator (clase padre de la actual)
            $this -> post_title = $post_title;
            $this -> post_url = $post_url;
            $this -> post_text = $post_text;
            $this -> post_is_active = $post_is_active;

            // Se guardan los valores recibidos en los campos de la clase EditedPostValidator
            $this -> initial_post_title = $initial_post_title;
            $this -> initial_post_url = $initial_post_url;
            $this -> initial_post_text = $initial_post_text;
            $this -> initial_post_is_active = $initial_post_is_active;

            // Verificamos si hubo cambios en la edición del Post
            if (($this -> post_title == $this -> initial_post_title) && ($this -> post_url == $this -> initial_post_url) && ($this -> post_text == $this -> initial_post_text) && ($this -> post_is_active == $this -> initial_post_is_active))
            {
                $this -> changes_made = false;
            }
            else
            {
                $this -> changes_made = true;
            }

            // Se comprueba si hubo cambios
            if ($this -> changes_made)
            { // Si hubo cambios...
                echo 'Hay cambios';

                // Se validan los campos variados de la clase y se almacena el error correspondiente a cada uno de ellos
                if ($this -> post_title != $initial_post_title)
                {
                    $this -> error_post_title = $this -> validate_post_title($connection, $post_title);
                }

                if ($this -> post_url != $initial_post_url)
                {
                    $this -> error_post_url = $this -> validate_post_url($connection, $post_url);
                }

                if ($this -> post_text != $initial_post_text)
                {
                    $this -> error_post_text = $this -> validate_post_text($post_text);
                }

                if ($this -> post_is_active != $initial_post_is_active)
                {
                    
                }
            }
            else
            { // Y si no hubo cambios...
                echo 'No hay cambios';

                // Redirigir al Gestor de Posts
            }

        }

        public function were_changes_made() {

            return $this -> changes_made;

        }

        // Getters de campos iniciales
        public function get_initial_post_title() {

            return $this -> initial_post_title;

        }

        public function get_initial_post_url() {

            return $this -> initial_post_url;

        }

        public function get_initial_post_text() {

            return $this -> initial_post_text;

        }

        public function get_initial_post_is_active() {

            return $this -> initial_post_is_active;

        }

        public function is_valid_edited_post() {

            // Verificamos que no haya ni un solo error...
            return $this -> is_valid_post() ? true : false;

        }

    }
    