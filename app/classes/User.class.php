<?php

    /**
     * Description of User
     *
     * @author Reinier
     */
    class User {

        private $user_id;
        private $user_firstname;
        private $user_secondname;
        private $user_lastname;
        private $user_email;
        private $user_password;

        #
        private $user_phone;
        private $user_gender;

        #
        private $user_is_active;
        private $user_kind;
        private $user_creation_date;
        private $user_image;

        // Constructor
        public function __construct($user_id, $user_firstname, $user_secondname, $user_lastname, $user_email, $user_password, $user_phone, $user_gender, $user_is_active, $user_kind, $user_creation_date, $user_image) {
            $this -> user_id = $user_id;
            $this -> user_firstname = $user_firstname;
            $this -> user_secondname = $user_secondname;
            $this -> user_lastname = $user_lastname;
            $this -> user_email = $user_email;
            $this -> user_password = $user_password;

            $this -> user_phone = $user_phone;
            $this -> user_gender = $user_gender;

            $this -> user_is_active = $user_is_active;
            $this -> user_kind = $user_kind;
            $this -> user_creation_date = $user_creation_date;
            $this -> user_image = $user_image;

        }

        # Getters de los campos

        public function get_user_id() {

            return $this -> user_id;

        }

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

            return $this -> user_password;

        }

        public function get_user_phone() {

            return $this -> user_phone;

        }

        public function get_user_gender() {

            return $this -> user_gender;

        }

        public function get_user_is_active() {

            return $this -> user_is_active;

        }

        public function get_user_kind() {

            return $this -> user_kind;

        }

        public function get_user_creation_date() {

            return $this -> user_creation_date;

        }

        public function get_user_image() {

            return $this -> user_image;

        }

        # Setters de los campos

        public function set_user_id($user_id) {

            $this -> user_id = $user_id;

        }

        public function set_user_firstname($user_firstname) {

            $this -> user_firstname = $user_firstname;

        }

        public function set_user_secondname($user_secondname) {

            $this -> user_secondname = $user_secondname;

        }

        public function set_user_lastname($user_lastname) {

            $this -> user_lastname = $user_lastname;

        }

        public function set_user_email($user_email) {

            $this -> user_email = $user_email;

        }

        public function set_user_password($user_password) {

            $this -> user_password = $user_password;

        }

        public function set_user_phone($user_phone) {

            $this -> user_phone = $user_phone;

        }

        public function set_user_gender($user_gender) {

            $this -> user_gender = $user_gender;

        }

        public function set_user_is_active($user_is_active) {

            $this -> user_is_active = $user_is_active;

        }

        public function set_user_kind($user_kind) {

            $this -> user_kind = $user_kind;

        }

       # public function set_user_creation_date($user_creation_date) { $this -> user_creation_date = $user_creation_date; }

        public function set_user_image($user_image) {

            $this -> user_image = $user_image;

        }

    }

?>