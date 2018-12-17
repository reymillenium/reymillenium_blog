<?php

    /**
     * Description of User
     *
     * @author Reinier
     */
    class Comment {

        private $comment_id;

        #
        private $comment_author_id;
        private $comment_post_id;

        #
        private $comment_title;
        private $comment_text;

        #
        private $comment_creation_date;

        // Constructor
        public function __construct($comment_id, $comment_author_id, $comment_post_id, $comment_title, $comment_text, $comment_creation_date) {

            $this -> comment_id = $comment_id;

            $this -> comment_author_id = $comment_author_id;
            $this -> comment_post_id = $comment_post_id;

            $this -> comment_title = $comment_title;
            $this -> comment_text = $comment_text;

            $this -> comment_creation_date = $comment_creation_date;

        }

        # Getters de los campos

        public function get_comment_id() {

            return $this -> comment_id;

        }

        public function get_comment_author_id() {

            return $this -> comment_author_id;

        }

        public function get_comment_post_id() {

            return $this -> comment_post_id;

        }

        public function get_comment_title() {

            return $this -> comment_title;

        }

        public function get_comment_text() {

            return $this -> comment_text;

        }

        public function get_comment_creation_date() {

            return $this -> comment_creation_date;

        }

        # Setters de los campos

        public function set_comment_id($comment_id) {

            $this -> comment_id = $comment_id;

        }

        public function set_comment_author_id($comment_author_id) {

            $this -> comment_author_id = $comment_author_id;

        }

        public function set_comment_post_id($comment_post_id) {

            $this -> comment_post_id = $comment_post_id;

        }

        public function set_comment_title($comment_title) {

            $this -> comment_title = $comment_title;

        }

        public function set_comment_text($comment_text) {

            $this -> comment_text = $comment_text;

        }

        # public function set_comment_creation_date($comment_creation_date) { $this -> comment_creation_date = $comment_creation_date; }

    }
    