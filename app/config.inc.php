<?php

    #*******************************************************************************************************************
    #                                       CONFIGURACIÓN DE ACCESO A LA BD
    #*******************************************************************************************************************
    #
    // Información de la configuración de acceso a la BD
    //if (!defined('constant')) { define('constant', 'value'); }
    if (!defined('SERVER_NAME'))
    {
        define('SERVER_NAME', 'localhost');
    }
    if (!defined('DB_NAME'))
    {
        define('DB_NAME', 'reymillenium_blog');
    }
    if (!defined('DB_USER_NAME'))
    {
        define('DB_USER_NAME', 'reinier');
    }
    if (!defined('DB_USER_PASSWORD'))
    {
        define('DB_USER_PASSWORD', 'DesfasatorDataBase2015*');
    }


    #*******************************************************************************************************************
    #                                         VISTAS & RUTAS
    #*******************************************************************************************************************
    #


    // *** Rutas de las interfaces o vistas del sitio Web (para enviar a Redirect) ***
    if (!defined('ROOT_FOLDER_NAME'))
    {
        define('ROOT_FOLDER_NAME', 'reymillenium_blog');
    }

    // *** Rutas de las interfaces o vistas del sitio Web (para enviar a Redirect) ***
    if (!defined('SERVER_URL'))
    {
        define('SERVER_URL', 'http://localhost/' . ROOT_FOLDER_NAME . '/');
    }
    if (!defined('AUTHORS_PAGE_URL'))
    {
        //??
        define("AUTHORS_PAGE_URL", SERVER_URL . "authors_page");
    }
    if (!defined('CORRECT_USER_REGISTRATION_PAGE_URL'))
    {
        define("CORRECT_USER_REGISTRATION_PAGE_URL", SERVER_URL . "correct_user_registration_page");
    }
    if (!defined('FAVORITS_PAGE_URL'))
    {
        // Aun no
        define("FAVORITS_PAGE_URL", SERVER_URL . "favorits_page");
    }
    if (!defined('MANAGER_PAGE_URL'))
    {
        // Carga varios formularios desde plantillas
        define("MANAGER_PAGE_URL", SERVER_URL . "manager_page");
    }
    if (!defined('MANAGER_PAGE_GENERIC_URL'))
    {
        // Página genérica de gestión
        define("MANAGER_PAGE_GENERIC_URL", MANAGER_PAGE_URL . "/generic");
    }
    if (!defined('MANAGER_PAGE_POSTS_URL'))
    {
        // Ruta de Gestión de Posts (carga una plantilla de Posts)
        define("MANAGER_PAGE_POSTS_URL", MANAGER_PAGE_URL . "/posts");
    }
    if (!defined('MANAGER_PAGE_COMMENTS_URL'))
    {
        // Ruta de Gestión de Comments (carga una plantilla de Comments)
        define("MANAGER_PAGE_COMMENTS_URL", MANAGER_PAGE_URL . "/comments");
    }
    if (!defined('MANAGER_PAGE_FAVORITS_URL'))
    {
        // Ruta de Gestión de Favorits (carga una plantilla de Favorits)
        define("MANAGER_PAGE_FAVORITS_URL", MANAGER_PAGE_URL . "/favorits");
    }
    if (!defined('MANAGER_PAGE_USERS_URL'))
    {
        // Ruta de Gestión de Users (carga una plantilla de Users)
        define("MANAGER_PAGE_USERS_URL", MANAGER_PAGE_URL . "/users");
    }
    if (!defined('NEW_POST_PAGE_URL'))
    {
        // Página de creación de un nuevo Post (carga 1 de 2 formularios)
        define("NEW_POST_PAGE_URL", SERVER_URL . "new_post_page");
    }
    if (!defined('EDITED_POST_PAGE_URL'))
    {
        // Página de edición de un Post
        define("EDITED_POST_PAGE_URL", SERVER_URL . "edited_post_page");
    }
    if (!defined('POST_PAGE_URL'))
    {
        // Página que muestra un Post, con 3 Posts aleatorios y sus comentarios debajo
        define("POST_PAGE_URL", SERVER_URL . "post_page");
    }
    if (!defined('POSTS_PAGE_URL'))
    {
        define("POSTS_PAGE_URL", SERVER_URL . "posts_page");
    }
    if (!defined('USER_LOGIN_PAGE_URL'))
    {
        // Página para loguearse el usuario
        define("USER_LOGIN_PAGE_URL", SERVER_URL . "user_login_page");
    }
    if (!defined('USER_LOGOUT_PAGE_URL'))
    {
        // Página que muestra lo satisfactorio o no del deslogueo
        define("USER_LOGOUT_PAGE_URL", SERVER_URL . "user_logout_page");
    }
    if (!defined('USER_REGISTRATION_PAGE_URL'))
    {
        // Página para que el usuario se registre
        define("USER_REGISTRATION_PAGE_URL", SERVER_URL . "user_registration_page");
    }
    if (!defined('USER_PROFILE_PAGE_URL'))
    {
        // Página para que el usuario visualice y/o edite sus campos
        define("USER_PROFILE_PAGE_URL", SERVER_URL . "user_profile_page");
    }
    if (!defined('PASSWORD_RECOVER_PAGE_URL'))
    {
        // Página para la recuperación de la contraseña
        define("PASSWORD_RECOVER_PAGE_URL", SERVER_URL . "password_recover_page");
    }

    if (!defined('MAIL_TEST_PAGE_URL'))
    {
        // Página para probar el envío de emails
        define("MAIL_TEST_PAGE_URL", SERVER_URL . "mail_test_page");
    }

    if (!defined('REWRITE_PASSWORD_PAGE_URL'))
    {
        // Página para probar el envío de emails
        define("REWRITE_PASSWORD_PAGE_URL", SERVER_URL . "rewrite_password_page");
    }

    if (!defined('SEARCH_PAGE_URL'))
    {
        // Página para probar el envío de emails
        define("SEARCH_PAGE_URL", SERVER_URL . "search_page");
    }
    #
    #*******************************************************************************************************************
    #                                               TEMPLATES
    #*******************************************************************************************************************
    #
    // Plantillas de la parte de Gestión de Contenidos (camino relativo desde las vistas) (No se usa SERVER_URL)
    if (!defined('MANAGER_PAGE_GENERIC_TEMPLATE_URL'))
    {
        define("MANAGER_PAGE_GENERIC_TEMPLATE_URL", "templates/page_inner_templates/manager_page_generic.inc.php");
    }
    if (!defined('MANAGER_PAGE_COMMENTS_TEMPLATE_URL'))
    {
        define("MANAGER_PAGE_COMMENTS_TEMPLATE_URL", "templates/page_inner_templates/manager_page_comments.inc.php");
    }
    if (!defined('MANAGER_PAGE_FAVORITS_TEMPLATE_URL'))
    {
        define("MANAGER_PAGE_FAVORITS_TEMPLATE_URL", "templates/page_inner_templates/manager_page_favorits.inc.php");
    }
    if (!defined('MANAGER_PAGE_LEFT_COLUMN_URL'))
    {
        define("MANAGER_PAGE_LEFT_COLUMN_URL", "templates/page_inner_templates/manager_page_left_column.inc.php");
    }
    if (!defined('MANAGER_PAGE_POSTS_TEMPLATE_URL'))
    {
        define("MANAGER_PAGE_POSTS_TEMPLATE_URL", "templates/page_inner_templates/manager_page_posts.inc.php");
    }
    if (!defined('MANAGER_PAGE_USERS_TEMPLATE_URL'))
    {
        define("MANAGER_PAGE_USERS_TEMPLATE_URL", "templates/page_inner_templates/manager_page_users.inc.php");
    }

    // Plantillas básicas a incluir en las interfaces (camino relativo desde las vistas) (No se usa SERVER_URL)
    if (!defined('PAGE_FOOTER_URL'))
    {
        define("PAGE_FOOTER_URL", "templates/page_basic_templates/page_footer.inc.php");
    }
    if (!defined('PAGE_HEAD_DECLARATION_URL'))
    {
        define("PAGE_HEAD_DECLARATION_URL", "templates/page_basic_templates/page_head_declaration.inc.php");
    }
    if (!defined('PAGE_HEADER_URL'))
    {
        define("PAGE_HEADER_URL", "templates/page_basic_templates/page_header.inc.php");
    }
    if (!defined('PAGE_LEFT_COLUMN_URL'))
    {
        define('PAGE_LEFT_COLUMN_URL', 'templates/page_basic_templates/page_left_column.inc.php');
    }

    // Copyright info
    if (!defined('WEB_SITE_COPYRIGHT_INFO'))
    {
        define("WEB_SITE_COPYRIGHT_INFO", "templates/page_basic_templates/web_site_copyright_info.inc.php");
    }

    // Others
    if (!defined('POST_COMMENTS_URL'))
    {
        define("POST_COMMENTS_URL", "templates/page_inner_templates/post_comments.inc.php");
    }
    if (!defined('RANDOM_POSTS_URL'))
    {
        // Muestra losts aleatorios debajo del post que está siendo visualizado
        define("RANDOM_POSTS_URL", "templates/page_inner_templates/random_posts.inc.php");
    }

    // Formularios a incluir en las interfaces (camino relativo desde las vistas) (No se usa SERVER_URL)
    if (!defined('NEW_POST_EMPTY_FORM_URL'))
    {
        define("NEW_POST_EMPTY_FORM_URL", "templates/forms/new_post_empty_form.inc.php");
    }
    if (!defined('NEW_POST_VALIDATED_FORM_URL'))
    {
        define("NEW_POST_VALIDATED_FORM_URL", "templates/forms/new_post_validated_form.inc.php");
    }

    if (!defined('EDITED_POST_INITIAL_FORM_URL'))
    {
        define("EDITED_POST_INITIAL_FORM_URL", "templates/forms/edited_post_initial_form.inc.php");
    }
    if (!defined('EDITED_POST_VALIDATED_FORM_URL'))
    {
        define("EDITED_POST_VALIDATED_FORM_URL", "templates/forms/edited_post_validated_form.inc.php");
    }

    if (!defined('USER_REGISTRATION_EMPTY_FORM_URL'))
    {
        define("USER_REGISTRATION_EMPTY_FORM_URL", "templates/forms/user_registration_empty_form.inc.php");
    }
    if (!defined('USER_REGISTRATION_VALIDATED_FORM_URL'))
    {
        define("USER_REGISTRATION_VALIDATED_FORM_URL", "templates/forms/user_registration_validated_form.inc.php");
    }

    if (!defined('USER_LOGIN_EMPTY_FORM_URL'))
    {
        define("USER_LOGIN_EMPTY_FORM_URL", "templates/forms/user_login_empty_form.inc.php");
    }
    if (!defined('USER_LOGIN_VALIDATED_FORM_URL'))
    {
        define("USER_LOGIN_VALIDATED_FORM_URL", "templates/forms/user_login_validated_form.inc.php");
    }

    if (!defined('USER_PROFILE_INITIAL_FORM_URL'))
    {
        define("USER_PROFILE_INITIAL_FORM_URL", "templates/forms/user_profile_initial_form.inc.php");
    }
    if (!defined('USER_PROFILE_VALIDATED_FORM_URL'))
    {
        define("USER_PROFILE_VALIDATED_FORM_URL", "templates/forms/user_profile_validated_form.inc.php");
    }

    if (!defined('PASSWORD_RECOVER_EMPTY_FORM_URL'))
    {
        define("PASSWORD_RECOVER_EMPTY_FORM_URL", "templates/forms/password_recover_empty_form.inc.php");
    }
    if (!defined('PASSWORD_RECOVER_VALIDATED_FORM_URL'))
    {
        define("PASSWORD_RECOVER_VALIDATED_FORM_URL", "templates/forms/password_recover_validated_form.inc.php");
    }

    if (!defined('REWRITE_PASSWORD_EMPTY_FORM_URL'))
    {
        define("REWRITE_PASSWORD_EMPTY_FORM_URL", "templates/forms/rewrite_password_empty_form.inc.php");
    }
    if (!defined('REWRITE_PASSWORD_VALIDATED_FORM_URL'))
    {
        define("REWRITE_PASSWORD_VALIDATED_FORM_URL", "templates/forms/rewrite_password_validated_form.inc.php");
    }

    if (!defined('SEARCH_EMPTY_FORM_URL'))
    {
        define("SEARCH_EMPTY_FORM_URL", "templates/forms/search_empty_form.inc.php");
    }
    if (!defined('SEARCH_VALIDATED_FORM_URL'))
    {
        define("SEARCH_VALIDATED_FORM_URL", "templates/forms/search_validated_form.inc.php");
    }


    #*******************************************************************************************************************
    #                                        CARPETAS CON RECURSOS
    #*******************************************************************************************************************
    #
    // Carpetas con recursos ( ruta absoluta = (desde la raíz de tu web))
    if (!defined('ALERTIFY_DIR_URL'))
    {
        define("ALERTIFY_DIR_URL", SERVER_URL . "alertifyjs/");
    }
    if (!defined('CSS_DIR_URL'))
    {
        define("CSS_DIR_URL", SERVER_URL . "css/");
    }
    if (!defined('BOOTSTRAP_DIR_URL'))
    {
        define("BOOTSTRAP_DIR_URL", SERVER_URL . "bootstrap-4.0.0-dist/");
    }
    if (!defined('FONTS_DIR_URL'))
    {
        define("FONTS_DIR_URL", SERVER_URL . "fonts/");
    }
    if (!defined('FONTAWESOME_DIR_URL'))
    {
        define("FONTAWESOME_DIR_URL", FONTS_DIR_URL . "font-awesome-4.7.0/");
    }
    if (!defined('IMAGES_DIR_URL'))
    {
        define("IMAGES_DIR_URL", SERVER_URL . "images/");
    }
    if (!defined('ICONS_DIR_URL'))
    {
        define("ICONS_DIR_URL", IMAGES_DIR_URL . "icons/");
    }
    if (!defined('JS_DIR_URL'))
    {
        define("JS_DIR_URL", SERVER_URL . "js/");
    }
    if (!defined('ROOT_DIR_URL'))
    {
        // Defino la carpeta REAL en la que estamos (válido para versiones de PHP inferiores a la 5.3)
        //define("ROOT_DIR_URL", realpath(dirname(__FILE__)) . "/..");
        // Defino la carpeta REAL en la que estamos (válido para versiones de PHP superiores a la 5.3)
        define("ROOT_DIR_URL", realpath(__DIR__) . "/../");
    }
    if (!defined('UPLOAD_DIR_URL'))
    {
        // Defino la carpeta REAL donde se almacenarán las imágenes subidas por los usuarios, de sus perfiles
        define("UPLOAD_DIR_URL", ROOT_DIR_URL . "images/profiles/uploads/");
    }
    if (!defined('DEFAULT_PROFILE_PICS_RELATIVE_DIR_URL'))
    {
        // Defino la carpeta RELATIVA donde se almacenan las imágenes default de los perfiles de los usuarios
        define("DEFAULT_PROFILE_PICS_RELATIVE_DIR_URL", SERVER_URL . "images/profiles/");
    }
    if (!defined('CUSTOM_PROFILE_PICS_RELATIVE_DIR_URL'))
    {
        // Defino la carpeta RELATIVA donde se almacenarán las imágenes subidas por los usuarios, de sus perfiles
        define("CUSTOM_PROFILE_PICS_RELATIVE_DIR_URL", DEFAULT_PROFILE_PICS_RELATIVE_DIR_URL . "uploads/");
    }

    #*******************************************************************************************************************
    #                                                CLASES OBJETO
    #*******************************************************************************************************************
    #
    // Clases (No se usa SERVER_URL)
    if (!defined('USER_CLASS_URL'))
    {
        define("USER_CLASS_URL", "app/classes/User.class.php");
    }
    if (!defined('POST_CLASS_URL'))
    {
        define("POST_CLASS_URL", "app/classes/Post.class.php");
    }
    if (!defined('COMMENT_CLASS_URL'))
    {
        define("COMMENT_CLASS_URL", "app/classes/Comment.class.php");
    }
    if (!defined('PASSWORD_RECOVERY_CLASS_URL'))
    {
        define("PASSWORD_RECOVERY_CLASS_URL", "app/classes/PasswordRecovery.class.php");
    }
    if (!defined('DIRTY_WORD_CLASS_URL'))
    {
        define("DIRTY_WORD_CLASS_URL", "app/classes/DirtyWord.class.php");
    }

    #*******************************************************************************************************************
    #                                        REPOSITORIOS DE CLASES OBJETO
    #*******************************************************************************************************************
    #
    // Repositorios (No se usa SERVER_URL)
    if (!defined('COMMENT_REPOSITORY_URL'))
    {
        define("COMMENT_REPOSITORY_URL", "app/repositories/CommentRepository.inc.php");
    }
    if (!defined('POST_REPOSITORY_URL'))
    {
        define("POST_REPOSITORY_URL", "app/repositories/PostRepository.inc.php");
    }
    if (!defined('USER_REPOSITORY_URL'))
    {
        define("USER_REPOSITORY_URL", "app/repositories/UserRepository.inc.php");
    }
    if (!defined('PASSWORD_RECOVERY_REPOSITORY_URL'))
    {
        define("PASSWORD_RECOVERY_REPOSITORY_URL", "app/repositories/PasswordRecoveryRepository.inc.php");
    }
    if (!defined('DIRTY_WORD_REPOSITORY_URL'))
    {
        define("DIRTY_WORD_REPOSITORY_URL", "app/repositories/DirtyWordRepository.inc.php");
    }


    #*******************************************************************************************************************
    #                                                VALIDADORES
    #*******************************************************************************************************************
    #
    // Validadores (No se usa SERVER_URL)
    if (!defined('POST_VALIDATOR_URL'))
    {
        define("POST_VALIDATOR_URL", "app/validators/post_validator.inc.php");
    }
    if (!defined('NEW_POST_VALIDATOR_URL'))
    {
        define("NEW_POST_VALIDATOR_URL", "app/validators/new_post_validator.inc.php");
    }
    if (!defined('EDITED_POST_VALIDATOR_URL'))
    {
        define("EDITED_POST_VALIDATOR_URL", "app/validators/edited_post_validator.inc.php");
    }

    if (!defined('USER_LOGIN_VALIDATOR_URL'))
    {
        define("USER_LOGIN_VALIDATOR_URL", "app/validators/user_login_validator.inc.php");
    }
    if (!defined('USER_REGISTRATION_VALIDATOR_URL'))
    {
        define("USER_REGISTRATION_VALIDATOR_URL", "app/validators/user_registration_validator.inc.php");
    }

    if (!defined('REWRITE_PASSWORD_VALIDATOR_URL'))
    {
        define("REWRITE_PASSWORD_VALIDATOR_URL", "app/validators/rewrite_password_validator.inc.php");
    }

    if (!defined('SEARCH_VALIDATOR_URL'))
    {
        define("SEARCH_VALIDATOR_URL", "app/validators/search_validator.inc.php");
    }

    #*******************************************************************************************************************
    #                                              FUNCIONALIDADES
    #*******************************************************************************************************************
    #
    // Funcionalidades (No se usa SERVER_URL)
    if (!defined('CONNECTION_URL'))
    {
        define("CONNECTION_URL", "app/Connection.inc.php");
    } // Daba explotes, pero solo en las vistas
    if (!defined('POSTS_WRITER_URL'))
    {
        define("POSTS_WRITER_URL", "app/utilities/PostsWriter.inc.php");
    }
    if (!defined('REDIRECTION_URL'))
    {
        define("REDIRECTION_URL", "app/utilities/Redirection.inc.php");
    }
    if (!defined('SESSION_CONTROL_URL'))
    {
        define("SESSION_CONTROL_URL", "app/utilities/SessionControl.inc.php");
    }

    if (!defined('DATE_UTILITIES_URL'))
    {
        define("DATE_UTILITIES_URL", "app/utilities/DateUtilities.inc.php");
    }
    if (!defined('STRING_UTILITIES_URL'))
    {
        define("STRING_UTILITIES_URL", "app/utilities/StringUtilities.inc.php");
    }


    #*******************************************************************************************************************
    #                                                   OTROS
    #*******************************************************************************************************************
    #
    // Test only
    if (!defined('CONFIG_URL'))
    {
        define("CONFIG_URL", "app/config.inc.php");
    }

    #*******************************************************************************************************************
    #                                                SCRIPTS
    #*******************************************************************************************************************
    #
    // Scripts
    if (!defined('DB_FILLING_SCRIPT'))
    {
        define("DB_FILLING_SCRIPT", "scripts/db_filling_script.php");
    }
    if (!defined('DELETE_POST_SCRIPT_URL'))
    {
        define("DELETE_POST_SCRIPT_URL", SERVER_URL . "delete_post");
    }
    if (!defined('DELETE_USER_SCRIPT_URL'))
    {
        define("DELETE_USER_SCRIPT_URL", SERVER_URL . "delete_user");
    }
    if (!defined('GENERATE_SECRET_URL_SCRIPT_URL'))
    {
        define("GENERATE_SECRET_URL_SCRIPT_URL", SERVER_URL . "generate_secret_url");
    }