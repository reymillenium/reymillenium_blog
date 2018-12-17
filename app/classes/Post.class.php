<?php

    /**
     * Description of User
     *
     * @author Reinier
     */
    class Post {

        private $post_id;
        
        #
        private $post_author_id;

        #
        private $post_title;
        private $post_url;
        private $post_text;

        #
        private $post_is_active;
        private $post_creation_date;

        // Constructor
        public function __construct($post_id, $post_author_id, $post_title, $post_url, $post_text, $post_is_active, $post_creation_date) {

            $this -> post_id = $post_id;
            $this -> post_author_id = $post_author_id;

            $this -> post_url = $post_url;
            $this -> post_title = $post_title;
            $this -> post_text = $post_text;

            $this -> post_is_active = $post_is_active;
            $this -> post_creation_date = $post_creation_date;

        }

        # Getters de los campos

        public function get_post_id() {

            return $this -> post_id;

        }

        public function get_post_author_id() {

            return $this -> post_author_id;

        }

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

        public function get_post_creation_date() {

            return $this -> post_creation_date;

        }

        # Setters de los campos

        public function set_post_id($post_id) {

            $this -> post_id = $post_id;

        }

        public function set_post_author_id($post_author_id) {

            $this -> post_author_id = $post_author_id;

        }

        public function set_post_title($post_title) {

            $this -> post_title = $post_title;

        }

        public function set_post_url($post_url) {

            $this -> $post_url = $post_url;

        }

        public function set_post_text($post_text) {

            $this -> post_text = $post_text;

        }

        function set_post_is_active($post_is_active) {

            $this -> post_is_active = $post_is_active;

        }

        # public function set_post_creation_date($post_creation_date) { $this -> post_creation_date = $post_creation_date; }

    }
    