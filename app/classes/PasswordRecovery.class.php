<?php

    class PasswordRecovery {

        private $password_recovery_id;

        #
        private $password_recovery_author_id;

        #
        private $password_recovery_secret_url;
        private $password_recovery_creation_date;

        public function __construct($password_recovery_id, $password_recovery_author_id, $password_recovery_secret_url, $password_recovery_creation_date) {

            $this -> password_recovery_author_id = $password_recovery_id;

            $this -> password_recovery_author_id = $password_recovery_author_id;

            $this -> password_recovery_secret_url = $password_recovery_secret_url;
            $this -> password_recovery_creation_date = $password_recovery_creation_date;

        }

        # Getters de los campos

        public function get_password_recovery_id() {

            return $this -> password_recovery_id;

        }

        public function get_password_recovery_author_id() {

            return $this -> password_recovery_author_id;

        }

        public function get_password_recovery_secret_url() {

            return $this -> password_recovery_secret_url;

        }

        public function get_password_recovery_creation_date() {

            return $this -> password_recovery_creation_date;

        }

        # Setters de los campos

        public function set_password_recovery_id($password_recovery_id) {

            $this -> password_recovery_id = $password_recovery_id;

        }

        public function set_password_recovery_author_id($password_recovery_author_id) {

            $this -> password_recovery_author_id = $password_recovery_author_id;

        }

        public function set_password_recovery_secret_url($password_recovery_secret_url) {

            $this -> password_recovery_secret_url = $password_recovery_secret_url;

        }

        public function set_password_recovery_creation_date($password_recovery_creation_date) {

            $this -> password_recovery_creation_date = $password_recovery_creation_date;

        }

    }
    