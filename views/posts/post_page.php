<?php

    include_once 'app/config.inc.php';
    include_once CONNECTION_URL;

    include_once USER_CLASS_URL;
    include_once POST_CLASS_URL;
    include_once COMMENT_CLASS_URL;

    include_once USER_REPOSITORY_URL;
    include_once POST_REPOSITORY_URL;
    include_once COMMENT_REPOSITORY_URL;

    include_once POSTS_WRITER_URL;
    include_once DATE_UTILITIES_URL;


    // Defino algunas variables utilitarias
    $line_break = '<br>';
    $page_title = $post -> get_post_title();

    // Cargo la declaración de mi página web
    include_once PAGE_HEAD_DECLARATION_URL;

    // Cargo el encabezado de la página html
    include_once PAGE_HEADER_URL;

?>

<!-- Main Content Container Begin -->
<div class="container post-article">

    <div class="row">
        <div class="col-md-12">
            <h2><?php echo $post -> get_post_title(); ?></h2>
        </div>
        <?php // include_once PAGE_LEFT_COLUMN_URL; ?>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
            <p>
                <strong>
                    Por 
                    <a href="#">
                        <i class="fa fa-user"></i> <?php echo UserRepository::get_user_by_id(Connection::get_connection(), $post -> get_post_author_id()) -> get_user_firstname() . ' '; ?>
                    </a>
                    el
                    <?php

                        echo DateUtilities::convert_date_to_spanish_format($post -> get_post_creation_date()) . '.';

                    ?>
                </strong>

            </p>
        </div>
    </div>
    <br>

    <div class="row">
        <div class="col-md-12 text-justify">
            <article>
                <?php echo nl2br($post -> get_post_text()); ?>
            </article>
        </div>
    </div>

    <!-- Incluimos una plantilla llamada random_posts, para mostrar 3 posts al azar -->
    <?php include_once RANDOM_POSTS_URL; ?>

    <br>

    <?php

        if (count($comments_of_the_post))
        {
            include_once POST_COMMENTS_URL;
        }
        else
        {
            echo '<p>Todavía no hay comentarios!</p>';
        }

    ?>
</div>
<!-- Main Content Container End -->

<?php include_once PAGE_FOOTER_URL; ?>