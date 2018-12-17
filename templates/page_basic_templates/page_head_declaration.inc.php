<!DOCTYPE html>
<html lang="en">

    <head>
        <?php

            if (!(isset($page_title)) || (empty($page_title)))
            {
                echo "<title>Blog de Reinier</title>";
            }
            else
            {
                echo "<title>$page_title</title>";
            }

        ?>

        <!-- Required meta tags -->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="keywords" content="">
        
        <!--Definimos el icono de la página-->
        <link rel="icon" type="image/png" href="<?php echo ICONS_DIR_URL ?>blog-icon.png"/>
        
        
        <!-- ********************************************************************************************************-->
        <!-- *********************************** Hojas de Estilo (CSS) ********************************************* -->
        <!-- ********************************************************************************************************-->

        <!-- Bootstrap CSS Files -->
        <!--<link rel="stylesheet" href="<?php // echo CSS_DIR_URL      ?>bootstrap.min.css">-->
        <link rel="stylesheet" href="<?php echo BOOTSTRAP_DIR_URL ?>css/bootstrap.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" crossorigin="anonymous"> 
        <!-- Footer de las páginas -->
        <link rel="stylesheet" href="<?php echo CSS_DIR_URL ?>Footer-with-logo.css">

        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?php echo FONTAWESOME_DIR_URL ?>css/font-awesome.css">

        <!-- Font Awesome Animated Icons -->
        <link rel="stylesheet" href="<?php echo CSS_DIR_URL ?>font-awesome-animation.css">

        <!-- Alertify: include the core style -->
        <link rel="stylesheet" href="<?php echo ALERTIFY_DIR_URL ?>css/alertify.min.css" />

        <!-- Alertify: include a theme -->
        <link rel="stylesheet" href="<?php echo ALERTIFY_DIR_URL ?>css/themes/default.min.css" />

        <!-- *** Ficheros .cs del programador *** -->
        <!-- Ficheros .cs con estilos generales -->
        <link rel="stylesheet" href="<?php echo CSS_DIR_URL ?>NewStyle.css">
        <!-- Estilos de tablas -->
        <link rel="stylesheet" href="<?php echo CSS_DIR_URL ?>tablesStyles.css">
        <!-- Emojis -->
        <link rel="stylesheet" href="<?php echo CSS_DIR_URL ?>emoji.css">


        <!-- ********************************************************************************************************-->
        <!-- ***************************** Ficheros con código JavaScript ****************************************** -->
        <!-- ********************************************************************************************************-->

        <!-- ** Dirección del fichero .js del plugin Alertify ** -->
        <script type="text/javascript" src="<?php echo ALERTIFY_DIR_URL ?>alertify.min.js"></script>

        <!-- Fichero .js de jQuery -->
        <script src="<?php echo JS_DIR_URL ?>jquery-3.3.1.js"></script>

        <!-- Fichero .js de Bootstrap -->
        <!--<script src="<?php // echo JS_DIR_URL      ?>bootstrap.min.js"></script>-->
        <script type="text/javascript" src="<?php echo BOOTSTRAP_DIR_URL ?>js/bootstrap.js"></script>
        
        <!-- Fichero .js de BootstrapFileStyle -->
        <script src="<?php echo JS_DIR_URL ?>bootstrap-filestyle.js"></script>
        
        <!-- Ficheros .js del programador -->
        <script type="text/javascript" src="<?php echo JS_DIR_URL ?>application.js"></script>

    </head>

    <body>