<div class="row">
    <div class="col-md-12">
        <h2>Gestión de las Entradas</h2>
        <!--<br>-->
        <a id="btn_new_post" class="btn btn-primary" href="<?php echo NEW_POST_PAGE_URL; ?>" role="button"><i class="fa fa-edit"></i> Crear Entrada</a>
        <br>
        <br>

        <div class="row posts_manager">
            <div class="col-md-12">
                <?php

                    if (count($posts_and_comments_amount) > 0)
                    {

                        ?>

                        <!-- División de Tabla Begin -->
                        <div id="div_tabla_posts"  class="div_tabla">

                            <table id="tbl_posts" cellspacing="0" cellpadding="0" class="standard-light-blue table table-striped">

                                <!-- Cabecera de la Tabla -->
                                <thead>
                                    <tr style="text-align: left;">
                                        <th>Fecha</th>
                                        <th>Título</th>
                                        <th>Estado</th>
                                        <th>Comentarios</th>
                                        <th></th>
                                        <th></th>
                                        <!--hola-->
                                    </tr>
                                </thead>
                                <!-- Fin de Cabecera de la Tabla -->

                                <!-- Cuerpo de la Tabla -->
                                <tbody>
                                    <?php

                                    for ($i = 0; $i < count($posts_and_comments_amount); $i++) {

                                        // Recupero el objeto Post del array bidimensional $posts_and_comments_amount
                                        $actual_post = $posts_and_comments_amount[$i][0];

                                        // Recupero el valor numérico actual_comments_amount del array bidimensional $posts_and_comments_amount
                                        $actual_post_comments_amount = $posts_and_comments_amount[$i][1];

                                        ?>

                                        <tr>
                                            <td><?php echo DateUtilities::convert_date_to_spanish_format($actual_post -> get_post_creation_date()); ?></td>

                                            <td><?php echo $actual_post -> get_post_title(); ?></td>

                                            <td>
                                                <?php

                                                if ($actual_post -> get_post_is_active() == 1)
                                                {
                                                    // Color verde para los Posts activos
                                                    echo '<span style="color: #34873E;"><span class="fa fa-check-circle"></span><strong> Activo</strong></span>';
                                                }
                                                else
                                                {
                                                    // Color rojo para los Posts inactivos
                                                    echo '<span style="color: #CC2C39;"><span class="fa fa-ban"></span><strong> Inactivo</strong></span>';
                                                }

                                                ?>
                                            </td>

                                            <td><?php echo $actual_post_comments_amount; ?></td>

                                            <td>
                                                <form name="edited_form" method="POST" action="<?php echo EDITED_POST_PAGE_URL; ?>">
                                                    <!--<div style="display: none;">-->
                                                    <input type="hidden" name="edited_post_id" value="<?php echo $actual_post -> get_post_id(); ?>">
                                                    <!--</div>-->
                                                    <button id="btn_edited_post" type="submit" class="btn btn-default btn-sm btn-success" name="edit_post"><i class="fa fa-edit"></i></button>
                                                </form>
                                                <!--<a class="btn btn-default btn-sm btn-success" href=""><i class="fa fa-edit"></i></a>-->
                                                <!--<a class="btn btn-default btn-sm btn-danger" href=""><i class="fa fa-trash"></i></a>-->
                                            </td>

                                            <td>
                                                <form name="delete_form" method="POST" action="<?php echo DELETE_POST_SCRIPT_URL; ?>">
                                                    <!--<div style="display: none;">-->
                                                    <input type="hidden" name="delete_post_id" value="<?php echo $actual_post -> get_post_id(); ?>">
                                                    <!--</div>-->
                                                    <button id="btn_delete_post" type="submit" class="btn btn-default btn-sm btn-danger" name="delete_post"><i class="fa fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>

                                        <?php

                                    }

                                    ?>

                                </tbody>
                                <!-- Fin de Cuerpo de la Tabla -->

                                <!-- Pie de Tabla -->
                                <tfoot>
                                    <tr>
                                        <!--<td> (Pie de la tabla) </td>-->
                                    </tr>
                                </tfoot>
                                <!-- Fin de Pie de Tabla -->

                            </table>
                            <!-- Fin de Tabla -->
                        </div>
                        <!-- Fin de la División de Tabla -->

                        <?php

                    }
                    else
                    {

                        ?>

                        <h3><i class="fa fa-frown-o"></i> Todavía no has escrito una entrada</h3>
                        <?php

                    }

                ?>

            </div>
            <!-- Fin de col-md-12 -->
        </div>
        <!-- Fin de row -->

    </div>

</div>