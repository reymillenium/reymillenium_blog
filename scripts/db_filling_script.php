<?php

    include_once 'app/config.inc.php';
    include_once 'app/Connection.inc.php';
    //include_once CONNECTION_URL;

    include_once USER_CLASS_URL;
    include_once POST_CLASS_URL;
    include_once COMMENT_CLASS_URL;

    include_once USER_REPOSITORY_URL;
    include_once POST_REPOSITORY_URL;
    include_once COMMENT_REPOSITORY_URL;

    Connection::open_connection();

    ##############################################
    #    ******  Introducir 100 users  ******    #
    ##############################################

    for ($users = 0; $users < 100; $users++) {
        // Para evitar que se repitan los campos, usamos unas funciones que crean strings, letters and numbers al azar

        $user_random_firstname = create_random_word(10);
        $user_random_secondname = create_random_word(10);
        $user_random_lastname = create_random_word(10);
        $user_random_email = create_random_string(5) . '@' . create_random_string(5) . '.' . create_random_string(3);
        $user_random_password = password_hash('123456', PASSWORD_DEFAULT);
        $user_random_phone = create_random_number(10);
        $user_random_gender = create_random_gender();
        $user_random_is_active = 1;
        $user_random_kind = create_random_kind();
        // $user_random_creation_date = '';
        $user_random_image = '';

        // Creamos un User
        $user = new User('', $user_random_firstname, $user_random_secondname, $user_random_lastname, $user_random_email, $user_random_password, $user_random_phone, $user_random_gender, $user_random_is_active, $user_random_kind, '', $user_random_image);

        // Introducimos en la BD el User 
        UserRepository::insert_user(Connection::get_connection(), $user);
    }

    ##############################################
    #    ******  Introducir 100 posts  ******    #
    ##############################################

    for ($posts = 0; $posts < 100; $posts++) {
        // Para evitar que se repitan los campos, usamos unas funciones que crean strings, letters and numbers al azar

        $post_random_author_id = rand(1, 100);

        $post_random_title = create_random_string(48);
        $post_random_url = $post_random_title;
        $post_random_text = create_lorem_ipsum_5_paragraphs();
        $post_random_is_active = 1;
        // $post_random_creation_date = '';
        #
        
        // Creamos un Post
        $post = new Post('', $post_random_author_id, $post_random_title, $post_random_url, $post_random_text, $post_random_is_active, '');

        // Introducimos en la BD el Post
        PostRepository::insert_post(Connection::get_connection(), $post);
    }

    #################################################
    #    ******  Introducir 100 comments  ******    #
    #################################################

    for ($comments = 0; $comments < 100; $comments++) {
        // Para evitar que se repitan los campos, usamos unas funciones que crean strings, letters and numbers al azar

        $comment_random_author_id = rand(1, 100);
        $comment_random_post_id = rand(1, 100);

        $comment_random_title = create_random_string(48);
        $comment_random_text = create_lorem_ipsum_5_paragraphs();
        // $comment_random_creation_date = '';
        #
        
        // Creamos un Comment
        $comment = new Comment('', $comment_random_author_id, $comment_random_post_id, $comment_random_title, $comment_random_text, '');

        // Introducimos en la BD el Comment
        CommentRepository::insert_comment(Connection::get_connection(), $comment);
    }


    ###############################################
    #    ******  Funciones Utilitarias  ******    #
    ###############################################

    function create_random_string($string_length) {

        $sample_string = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        // Determinamos cuántos caracteres hay en la mustra de caracteres
        $sample_string_length = strlen($sample_string);

        // Creamos el string aleatorio y lo dejamos en blanco por ahora
        $random_string = '';

        // Creamos nuestro string aleatorio
        for ($i = 0; $i < $string_length; $i++) {
            $random_string .= $sample_string[rand(0, $sample_string_length - 1)];
        }

        return $random_string;

    }

    function create_random_word($word_length) {
        $sample_letters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        // Determinamos cuántos números hay en la muestra de números
        $sample_letters_length = strlen($sample_letters);

        // Creamos el string aleatorio y lo dejamos en blanco por ahora
        $random_word = '';

        // Creamos nuestro string aleatorio
        for ($i = 0; $i < $word_length; $i++) {
            $random_word .= $sample_letters[rand(0, $sample_letters_length - 1)];
        }

        return $random_word;

    }

    function create_random_number($number_length) {
        $sample_numbers = '1234567890';

        // Determinamos cuántos números hay en la muestra de números
        $sample_numbers_length = strlen($sample_numbers);

        // Creamos el string aleatorio y lo dejamos en blanco por ahora
        $random_number = '';

        // Creamos nuestro string aleatorio
        for ($i = 0; $i < $number_length; $i++) {
            $random_number .= $sample_numbers[rand(0, $sample_numbers_length - 1)];
        }

        return $random_number;

    }

    function create_random_gender() {

        $sample_genders = ['Female', 'Male', 'Freak'];

        // Determinamos cuántos números hay en la muestra de números
        $sample_genders_length = count($sample_genders);

        // Creamos la variable para el gender aleatorio y lo dejamos en blanco por ahora
        $random_gender = '';

        // Creamos nuestro gender aleatorio
        $random_gender .= $sample_genders[rand(0, $sample_genders_length - 1)];

        return $random_gender;

    }

    function create_random_kind() {

        $sample_kinds = ['Administrator', 'Operator', 'Guest'];

        // Determinamos cuántos números hay en la muestra de números
        $sample_kinds_length = count($sample_kinds);

        // Creamos la variable para el gender aleatorio y lo dejamos en blanco por ahora
        $random_kind = '';

        // Creamos nuestro gender aleatorio
        $random_kind .= $sample_kinds[rand(0, $sample_kinds_length - 1)];

        return $random_kind;

    }

    function create_lorem_ipsum_5_paragraphs() {
        $loren_ipsum_string = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus sit amet purus semper, varius velit a, facilisis ex. Ut aliquet erat quis dictum ullamcorper. Praesent ultricies fringilla libero ac lacinia. Fusce egestas est a tristique venenatis. Morbi lacinia mattis bibendum. Morbi ac pulvinar nisl. Nunc bibendum mauris non libero accumsan, in fringilla eros iaculis. Quisque vitae ullamcorper tellus. Mauris vulputate aliquam erat id iaculis. Mauris velit erat, scelerisque sed ex eget, commodo suscipit diam. Curabitur tristique ligula nulla, et dapibus neque lobortis at. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Mauris orci arcu, vestibulum ac blandit nec, tempus quis nulla. Praesent risus nisi, ornare eget ligula in, consequat luctus felis. Curabitur viverra et augue at scelerisque. Donec tristique justo eu nunc ultrices sollicitudin.

Maecenas et tincidunt tortor. Aenean lobortis sit amet erat vehicula consequat. Duis ac gravida est. Donec cursus dapibus dolor a convallis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut dapibus eros et libero venenatis, nec aliquet felis elementum. Nam finibus ex eget ligula pretium, ut cursus orci placerat. Pellentesque ac lorem ligula. Fusce in metus vel arcu tempus volutpat vitae id enim. Quisque commodo condimentum sapien quis placerat. Nulla egestas, magna nec vestibulum mollis, sem sapien elementum lorem, in vulputate nisl erat ut nisl. Ut volutpat, lectus sit amet condimentum lobortis, leo elit fermentum lorem, sed vehicula neque lacus sed tortor.

Nam tincidunt pretium elit, et scelerisque justo varius sed. Vestibulum non vulputate orci, mattis pharetra elit. Suspendisse vehicula lacinia posuere. Mauris sit amet nisi elit. Aenean pretium lobortis blandit. Nulla bibendum a ligula at dapibus. Donec euismod, dolor sit amet aliquam laoreet, nulla eros auctor leo, a blandit enim erat id arcu. In rhoncus, urna non accumsan sagittis, enim arcu mollis tellus, id hendrerit metus magna non nunc.

In eu condimentum est. Maecenas aliquam in felis in congue. Nulla sollicitudin, nulla in iaculis tincidunt, nulla risus pharetra odio, sed molestie nibh nunc nec nibh. Morbi et nulla non massa rutrum vehicula sed eu dolor. Suspendisse hendrerit lectus nec blandit accumsan. Nam tincidunt vehicula dolor, ac lobortis nisi feugiat eget. Aliquam mattis nisi sodales quam facilisis, a dictum dolor tempor.

Praesent ac auctor lectus. Phasellus ut ligula tortor. Aenean sit amet enim dolor. Proin nec mollis massa. Quisque tempor, lorem nec ullamcorper ullamcorper, ligula lorem placerat ligula, sed placerat ipsum diam non urna. Suspendisse eget turpis enim. Etiam imperdiet commodo gravida.';

        return $loren_ipsum_string;

    }
    
//      Pueden haber 2 errores:
//      Error de límite de tiempo
//      Error de límite de memoria (128 Mb x objeto?? No cambiarlo)