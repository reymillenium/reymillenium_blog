<?php 
    
    class StringUtilities {
        
        public static function started_variable($variable) {

            if (isset($variable) && !empty($variable))
            {
                return true;
            }
            else
            {
                return false;
            }

        }

        public static function no_spaces($variable) {

            // Verifico si la cantidad de apariciones de los espacios en blanco en la variable es cero o no.
            return substr_count($variable, ' ') == 0 ? true : false;

        }
        
        public static function only_spaces($variable) {
           
            // Verifico si la variable tiene solo espacios en blanco o no.
            return trim($variable) == '' ? true : false;

        }

        public static function no_spaces2($variable) {

            // Verifico si el length de la variable es igual o no al de la misma luego de quitarle los posibles espacios en blanco
            return strlen($variable) == strlen(trim($variable)) ? true : false;

        }

        public static function no_spaces_premium($variable) {

            // Quitamos los espacios en blanco obvios
            $treated_variable = trim($variable);

            // Quitamos los espacios en blanco menos obvios (codificaciones especiales)
            $treated_variable = str_replace(' ', '', $treated_variable);

            // Quitamos los espacios en blanco para codificaciones que php no entienda
            $treated_variable = preg_replace('/\s+/', '', $treated_variable);

            // Verifico si el length de la variable es igual o no al de la misma luego de quitarle los posibles espacios en blanco
            return strlen($treated_variable) == strlen($variable) ? true : false;

        }

        public static function only_letters_and_accents($variable) {

            // Valida para solo letras con acentos y para eñes
            if (preg_match("/^[a-zA-Z áéíóúAÉÍÓÚÑñ]+$/", $variable))
            {
                // echo utf8_decode($variable);
                return true;
            }
            else
            {
                return false;
            }

        }

        
        
        
        
    }
    