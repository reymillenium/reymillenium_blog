<?php

    //include_once 'app/Connection.inc.php';
    include_once CONNECTION_URL;

    include_once POST_REPOSITORY_URL;
    include_once POST_CLASS_URL;
    include_once USER_REPOSITORY_URL;
    include_once USER_CLASS_URL;

    class PostsWriter {

        public static function write_all_the_posts() {
            $posts = PostRepository::get_all_the_posts_by_descending_date(Connection::get_connection());

            if (count($posts))
            {

                foreach ($posts as $post) {

                    self::write_a_post($post);
                }
            }

        }

        public static function write_all_the_summarized_posts() {
            $posts = PostRepository::get_all_the_posts_by_descending_date(Connection::get_connection());

            if (count($posts))
            {

                foreach ($posts as $post) {

                    self::write_a_summarize_post($post);
                }
            }

        }

        public static function write_paged_posts($initial_index, $page_limit) {

            $paged_posts = PostRepository::get_paged_posts_by_descending_date(Connection::get_connection(), $initial_index, $page_limit);

            if (count($paged_posts))
            {

                foreach ($paged_posts as $post) {

                    self::write_a_summarize_post($post);
                }
            }

        }

        public static function write_a_summarize_post($post) {

            if (!isset($post))
            {
                return;
            }

            ?>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong style="color: black;">Título: </strong> <?php echo $post -> get_post_title(); ?>
                        </div>
                        <div class="card-body">
                            <p>
                                <strong>Autor: </strong><?php echo UserRepository::get_user_by_id(Connection::get_connection(), $post -> get_post_author_id()) -> get_user_firstname() . ' '; ?> <strong> Fecha: </strong><?php echo $post -> get_post_creation_date(); ?>
                            </p>
                            <div class="text-justify">
                                <?php echo nl2br(self::summarize_text($post -> get_post_text())); ?>
                            </div>
                            <br>
                            <div class="text-left">
                                <a class="btn btn-primary btn-sm" href="<?php echo POST_PAGE_URL . '/' . $post -> get_post_url(); ?>" role="button">Seguir leyendo</a>
                            </div>
                        </div>

                        <div class="card-footer">
                            <?php include WEB_SITE_COPYRIGHT_INFO; ?>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <?php

        }

        public static function write_a_post($post) {

            if (!isset($post))
            {
                return;
            }

            ?>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong style="color: black;">Título: </strong> <?php echo $post -> get_post_title(); ?>
                        </div>
                        <div class="card-body">
                            <p>
                                <strong>Autor: </strong><?php echo UserRepository::get_user_by_id(Connection::get_connection(), $post -> get_post_author_id()) -> get_user_firstname() . ' '; ?> <strong> Fecha: </strong><?php echo $post -> get_post_creation_date(); ?>
                            </p>
                            <div class="text-justify">
                                <?php echo nl2br($post -> get_post_text()); ?>
                            </div>
                            <br>
                            <div class="text-left">
                                <a class="btn btn-primary btn-sm" href="#" role="button">Seguir leyendo</a>
                            </div>
                        </div>

                        <div class="card-footer">
                            <?php include WEB_SITE_COPYRIGHT_INFO; ?>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <?php

        }

        // Búsqueda de Posts
        public static function write_searched_posts($posts) {

            for ($i = 1; $i <= count($posts); $i++) {

                if (($i + 2) % 3 == 0)
                {

                    ?> 
                    <div class="row">
                        <?php

                    }
                    //  Recupero el post individual del array $posts
                    $actual_post = $posts[$i - 1];

                    // Escribo la entrada
                    self::write_actual_searched_post($actual_post);

                    if (($i % 3 == 0) || ($i == count($posts)))
                    {

                        ?>
                    </div><br>

                    <?php

                }
            }

        }

        public static function write_actual_searched_post($post) {

            if (!isset($post))
            {
                return;
            }

            ?>
            <!--<div class="row">-->
            <div class="col-md-4">
                <div class="card">

                    <div class="card-header">
                        <strong style="color: black;">Título: </strong> <?php echo $post -> get_post_title(); ?>
                    </div>

                    <div class="card-body">
                        <p>
                            <strong>Autor: </strong><?php echo UserRepository::get_user_by_id(Connection::get_connection(), $post -> get_post_author_id()) -> get_user_firstname() . ' '; ?> <strong> Fecha: </strong><?php echo $post -> get_post_creation_date(); ?>
                        </p>
                        <div class="text-justify">
                            <?php

                            //echo nl2br($post -> get_post_text()); 
                            echo nl2br(self::summarize_text($post -> get_post_text()));

                            ?>
                        </div>
                        <br>
                        <div class="text-left">
                            <a class="btn btn-primary btn-sm" href="#" role="button">Seguir leyendo</a>
                        </div>
                    </div>

                    <div class="card-footer">
            <?php include WEB_SITE_COPYRIGHT_INFO; ?>
                    </div>

                </div>
            </div>
            <!--</div>-->
            <!--<br>-->
            <?php

        }

        // Resume un Post
        public static function summarize_text($post_text) {

            $maximum_length = 352;
            $summarize_text = '';

            if (strlen($post_text) <= $maximum_length)
            { // Si el texto es menor o igual...
                $summarize_text = $post_text;
            }
            else
            { // Si el texto es mayor...
                $summarize_text .= substr($post_text, 0, $maximum_length) . '...';
            }
            return $summarize_text;

        }

    }
    