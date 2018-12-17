<?php

    /**
     * Description of DirtyWord
     *
     * @author Reinier
     */
    class DirtyWord {

        private $dirty_word_id;

        #
        private $dirty_word_name;
        private $dirty_word_language;

        // Constructor
        public function __construct($dirty_word_id, $dirty_word_name, $dirty_word_language) {

            $this -> dirty_word_id = $dirty_word_id;

            $this -> dirty_word_name = $dirty_word_name;
            $this -> dirty_word_language = $dirty_word_language;

        }

        # Getters de los campos

        public function get_dirty_word_id() {

            return $this -> dirty_word_id;

        }

        public function get_dirty_word_name() {

            return $this -> dirty_word_name;

        }

        public function get_dirty_word_language() {

            return $this -> dirty_word_language;

        }

        # Setters de los campos

        public function set_dirty_word_name($dirty_word_name) {

            $this -> dirty_word_name = $dirty_word_name;

        }

        public function set_dirty_word_language($dirty_word_language) {

            $this -> dirty_word_language = $dirty_word_language;

        }

    }
    