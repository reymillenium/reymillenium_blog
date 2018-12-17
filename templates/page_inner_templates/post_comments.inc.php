<div class="row">
    <div class="col-md-12">
        <button class="btn btn-primary form-control" data-toggle="collapse" data-target="#comments">
            <?php

                echo "ver comentarios (" . count($comments_of_the_post) . ")";

            ?>
        </button>

        <br><br>

        <div id="comments" class="collapse">
            <?php

                for ($i = 0; $i < count($comments_of_the_post); $i++) {
                    $actual_comment = $comments_of_the_post[$i];

                    ?>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                
                                <div class="card-header">
                                    <?php echo $actual_comment -> get_comment_title(); ?>
                                </div>

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col col-md-2">
                                            <?php echo UserRepository::get_user_by_id(Connection::get_connection(), $actual_comment -> get_comment_author_id()) -> get_user_firstname(); ?>
                                        </div>
                                        
                                        <div class="col col-md-10">
                                            <p>
                                                <?php echo DateUtilities::convert_date_to_spanish_format($actual_comment -> get_comment_creation_date()); ?>
                                            </p>
                                            <p class="text-justify">
                                                <?php echo nl2br($actual_comment -> get_comment_text()); ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>


                    <?php

                }

            ?>         
        </div>


    </div>

</div>
