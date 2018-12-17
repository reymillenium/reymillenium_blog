<div class="row">
    <div class="col-md-12">
        <h2>Gestión de los Usuarios</h2>
        <!--<br>-->
        <a id="btn_new_user" class="btn btn-primary" href="<?php echo USER_REGISTRATION_PAGE_URL; ?>" role="button"><i class="fa fa-user-plus"></i> Crear Usuario</a>
        <br>
        <br>

        <div class="row posts_manager">
            <div class="col-md-12">
                <?php

                    if (count($users) > 0)
                    {

                        ?>

                        <!-- División de Tabla Begin -->
                        <div id="div_tabla_users"  class="div_tabla">

                            <table id="tbl_users" cellspacing="0" cellpadding="0" class="standard-light-blue table table-striped">

                                <!-- Cabecera de la Tabla -->
                                <thead>
                                    <tr style="text-align: left;">
                                        <th>Nombre</th>
                                        <th>Email</th>
                                        <th>Teléfono</th>
                                        <th>Sexo</th>
                                        <th>Tipo</th>
                                        <th></th>
                                        <th></th>
                                        <!--hola-->
                                    </tr>
                                </thead>
                                <!-- Fin de Cabecera de la Tabla -->

                                <!-- Cuerpo de la Tabla -->
                                <tbody>
                                    <?php

                                    for ($i = 0; $i < count($users); $i++) {

                                        // Recupero el objeto User del array unidimensional $users
                                        $actual_user = $users[$i];

                                        ?>

                                        <tr>
                                            <td><?php echo $actual_user -> get_user_firstname(); ?></td>

                                            <td><?php echo $actual_user -> get_user_email(); ?></td>
                                            
                                            <td><?php echo $actual_user -> get_user_phone(); ?></td>

                                            <td><?php echo $actual_user -> get_user_gender(); ?></td>

                                            <td>
                                                <?php

                                                if ($actual_user -> get_user_kind() == 'Administrator')
                                                {
                                                    // Color rojo para los Users con kind = Administrator
                                                    echo '<span style="color: #CC2C39;"><span class="fa fa-graduation-cap"></span><strong> Administrador</strong></span>';
                                                }
                                                else if ($actual_user -> get_user_kind() == 'Operator')
                                                {
                                                    // Color verde para los Users con kind = Operator
                                                    echo '<span style="color: #34873E;"><span class="fa fa-user"></span><strong> Operador</strong></span>';
                                                }
                                                else if ($actual_user -> get_user_kind() == 'Guest')
                                                {
                                                    // Color amarillo para los Users con kind = Guest
                                                    echo '<span style="color: #F9D672;"><span class="fa fa-user-o"></span><strong> Invitado</strong></span>';
                                                }

                                                ?>
                                            </td>

                                            <td>
                                                <form name="edited_form" method="POST" action="<?php echo EDITED_POST_PAGE_URL; ?>">
                                                    <!--<div style="display: none;">-->
                                                    <input type="hidden" name="edited_post_id" value="<?php echo $actual_user -> get_user_id(); ?>">
                                                    <!--</div>-->
                                                    <button id="btn_edited_user" type="submit" class="btn btn-default btn-sm btn-success" name="edit_user"><i class="fa fa-edit"></i></button>
                                                </form>
                                                <!--<a class="btn btn-default btn-sm btn-success" href=""><i class="fa fa-edit"></i></a>-->
                                                <!--<a class="btn btn-default btn-sm btn-danger" href=""><i class="fa fa-trash"></i></a>-->
                                            </td>

                                            <td>
                                                <form name="delete_form" method="POST" action="<?php echo DELETE_USER_SCRIPT_URL; ?>">
                                                    <!--<div style="display: none;">-->
                                                    <input type="hidden" name="delete_user_id" value="<?php echo $actual_user -> get_user_id(); ?>">
                                                    <!--</div>-->
                                                    <button id="btn_delete_user" type="submit" class="btn btn-default btn-sm btn-danger" name="delete_user"><i class="fa fa-trash"></i></button>
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

                        <h3><i class="fa fa-frown-o"></i> No existen usuarios registrados</h3>
                        <?php

                    }

                ?>

            </div>
            <!-- Fin de col-md-12 -->
        </div>
        <!-- Fin de row -->

    </div>

</div>