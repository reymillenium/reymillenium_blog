<?php

    class DateUtilities {

        public static function convert_date_to_spanish_format($date) {

            // Recortamos la fecha para obtener los diez primeros caracteres
            $date = substr($date, 0, 10);

            // Obtenemos el número de día, el día (nombre del día), el mes y el año. 
            $numeroDia = date('d', strtotime($date));
            $dia = date('l', strtotime($date));
            $mes = date('F', strtotime($date));
            $anio = date('Y', strtotime($date));

            // Pasamos a castellano/español el nombre del día y del mes, usando str_replace().
            $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
            $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
            $nombredia = str_replace($dias_EN, $dias_ES, $dia);
            $meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
            $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
            $nombreMes = str_replace($meses_EN, $meses_ES, $mes);

            // Reduzco el número de dígitos en el número de días de dos a uno, cuando su valor es menor que 10
            if ($numeroDia < 10)
            {
                if ($numeroDia[0] == '0')
                {
                    $numeroDia = $numeroDia[1];
                }
            }

            //  Devolvemos los datos en una sintaxis clara
            return $nombredia . " " . $numeroDia . " de " . $nombreMes . " de " . $anio;

        }

        public static function convert_date_to_english_format($date) {

            // Recortamos la fecha para obtener los diez primeros caracteres
            $date = substr($date, 0, 10);

            // Obtenemos el número de día, el día (nombre del día), el mes y el año. 
            $numeroDia = date('d', strtotime($date));
            $dia = date('l', strtotime($date));
            $mes = date('F', strtotime($date));
            $anio = date('Y', strtotime($date));

            // Reduzco el número de dígitos en el número de días de dos a uno, cuando su valor es menor que 10
            if ($numeroDia < 10)
            {
                if ($numeroDia[0] == '0')
                {
                    $numeroDia = $numeroDia[1];
                }
            }

            //  Devolvemos los datos en una sintaxis clara
            return $dia . ", " . $mes . " " . $numeroDia . ", " . $anio;

        }

        public static function convert_date_to_english_formal_format($date) {

            // Recortamos la fecha para obtener los diez primeros caracteres
            $date = substr($date, 0, 10);

            // Obtenemos el número de día, el día (nombre del día), el mes y el año. 
            $numeroDia = date('d', strtotime($date));
            $dia = date('l', strtotime($date));
            $mes = date('F', strtotime($date));
            $anio = date('Y', strtotime($date));

            // Reduzco el número de dígitos en el número de días de dos a uno, cuando su valor es menor que 10
            if ($numeroDia < 10)
            {
                if ($numeroDia[0] == '0')
                {
                    $numeroDia = $numeroDia[1];
                }
            }

            // Declaramos una variable para el día del mes con formalidad ordenal
            $formalMonthDay = '';

            // Ahora agregamos la formalidad ordenal correcta al día del mes, end ependencia del valor del mismo
            switch ($numeroDia) {
                case 1:
                    $formalMonthDay = '1st';
                    break;
                case 2:
                    $formalMonthDay = '2nd';
                    break;
                case 3:
                    $formalMonthDay = '3rd';
                    break;
                case 21:
                    $formalMonthDay = '21st';
                    break;
                case 22:
                    $formalMonthDay = '22nd';
                    break;
                case 23:
                    $formalMonthDay = '23rd';
                    break;
                case 31:
                    $formalMonthDay = '31st';
                    break;

                default:
                    $formalMonthDay = $numeroDia . 'th';
                    break;
            }

            //  Devolvemos los datos en una sintaxis clara
            return $dia . ", " . $mes . " " . $formalMonthDay . ", " . $anio;

        }

    }
    