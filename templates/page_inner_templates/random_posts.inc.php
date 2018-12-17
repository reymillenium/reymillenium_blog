<div class="row">
    <div class="col-md-12">
        <hr>
        <h3>Otras entradas interesantes:</h3>
    </div>

    <?php

        for ($i = 0; $i < count($random_posts); $i++) {

            $actual_post = $random_posts[$i];

            ?>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <?php echo $actual_post -> get_post_title(); ?>
                    </div>
                    <div class="card-body">
                        <p>
                            <?php echo nl2br(PostsWriter::summarize_text($actual_post -> get_post_text())); ?>
                        </p>
                    </div>
                    <div class="card-footer">

                    </div>
                </div>


            </div>    


            <?php

        }

    ?>
    <div class="col-md-12">
        <hr>
    </div>
</div>

