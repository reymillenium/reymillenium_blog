<div class="row">

    <div class="col-md-8">

        <div class="form-group">
            <div class="col-sm-offset-2 col-md-12 input-group">
                <div class="input-group-addon col-md-1">
                    <i class="fa fa-address-card"></i>
                </div>
                <input type="text" id="txt_user_firstname" class="form-control col-md-11" placeholder="Nombre" name="user_firstname" autofocus value="<?php echo $initial_user -> get_user_firstname(); ?>">
            </div>
            <input type="hidden" id="hddn_initial_user_firstname" name="initial_first_name" value="<?php echo $initial_user -> get_user_firstname(); ?>">
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-md-12 input-group">
                <div class="input-group-addon col-md-1">
                    <i class="fa fa-address-card"></i>
                </div>
                <input type="text" id="txt_user_secondname" class="form-control col-md-11" placeholder="Segundo nombre" name="user_secondname" value="<?php echo $initial_user -> get_user_secondname(); ?>">
            </div>
            <input type="hidden" id="hddn_initial_user_secondname" name="initial_user_secondname" value="<?php echo $initial_user -> get_user_secondname(); ?>">
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-md-12 input-group">
                <div class="input-group-addon col-md-1">
                    <i class="fa fa-address-card"></i>
                </div>
                <input type="text" id="txt_user_lastname" class="form-control col-md-11" placeholder="Apellidos" name="user_lastname" value="<?php echo $initial_user -> get_user_lastname(); ?>">
            </div>
            <input type="hidden" id="hddn_initial_user_lastname" name="initial_user_lastname" value="<?php echo $initial_user -> get_user_lastname(); ?>">
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-md-12 input-group">
                <div class="input-group-addon col-md-1">
                    <i class="fa fa-envelope"></i>
                </div>
                <input type="email" id="txt_user_email" class="form-control col-md-11" placeholder="Email" name="user_email" value="<?php echo $initial_user -> get_user_email(); ?>">
            </div>
            <input type="hidden" id="hddn_initial_user_email" name="initial_user_email" value="<?php echo $initial_user -> get_user_email(); ?>">
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-md-12 input-group">
                <div class="input-group-addon col-md-1">
                    <i class="fa fa-key"></i>
                </div>
                <input type="password" id="txt_user_password1" class="form-control col-md-11" placeholder="Password" name="user_password1">
            </div>
            <input type="hidden" id="hddn_initial_user_password" name="initial_user_password" value="<?php echo $initial_user -> get_user_password(); ?>">
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-md-12 input-group">
                <div class="input-group-addon col-md-1">
                    <i class="fa fa-key"></i>
                </div>
                <input type="password" id="txt_user_password2" class="form-control col-md-11" placeholder="Repita su password" name="user_password2">
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-md-12 input-group">
                <div class="input-group-addon col-md-1">
                    <i class="fa fa-phone"></i>
                </div>
                <input type="text" id="txt_user_phone" class="form-control col-md-11" placeholder="Teléfono" name="user_phone" maxlength="10" value="<?php echo $initial_user -> get_user_phone(); ?>">
            </div>
            <input type="hidden" id="hddn_initial_user_phone" name="initial_user_phone" value="<?php echo $initial_user -> get_user_phone(); ?>">
        </div>

        <div class="form-group">
            <!--<label id="lbl_user_gender" class="control-label col-sm-2" for="user_gender">Género:</label>-->
            <div class="col-md-12">  

                <select id="slct_user_gender" class="form-control col-md-12" name="user_gender" title="Choose one of the following...">
                    <option value="Male" <?php echo $initial_user -> get_user_gender() == 'Male' ? ' selected="true"' : ''; ?>>&#xf222; Masculino </option>
                    <option value="Female" <?php echo $initial_user -> get_user_gender() == 'Female' ? ' selected="true"' : ''; ?>>&#xf221; Femenino </option>
                    <option value="Freak" <?php echo $initial_user -> get_user_gender() == 'Freak' ? ' selected="true"' : ''; ?>>&#xf224; Freak</option>
                </select>

            </div>
        </div>

        <div class="form-group">
            <!--<label id="lbl_user_kind" class="control-label col-sm-2" for="user_kind">Tipo:</label>-->
            <div class="col-md-12">  

                <select id="slct_user_kind" class="form-control col-md-12" name="user_kind">
                    <option value="Administrator" <?php echo $initial_user -> get_user_kind() == 'Administrator' ? ' selected="true"' : ''; ?>>&#xf19d; Administrador</option>
                    <option value="Operator" <?php echo $initial_user -> get_user_kind() == 'Operator' ? ' selected="true"' : ''; ?>>&#xf007; Operador</option>
                    <option value="Guest" <?php echo $initial_user -> get_user_kind() == 'Guest' ? ' selected="true"' : ''; ?>>&#xf183; Invitado</option>
                </select>

            </div>
        </div>



        <!--                            <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <div class="checkbox">
                                                <label><input type="checkbox" name="remember"> Remember me</label>
                                                <label id="lbl_destroy_session" for=""><input type="checkbox" id="chbx_session" name="session" value="1">Recordar mis datos (alargar sesión)</label>
                                            </div>
                                        </div>
                                    </div>-->

        <div class="form-group">     
            <div class="col-sm-offset-2 col-md-12">

                <button type="submit" id="btn_update_profile" class="btn btn-default btn-success faa-parent animated-hover" name="update_profile">
                    <i class="fa fa-sign-in faa-horizontal fa-fast"></i>
                    Actualizar
                </button>

                <button type="reset" id="btn_eraser" class="btn btn-default btn-secondary faa-parent animated-hover">
                    <i class="fa fa-eraser faa-ring fa-fast"></i>
                    Limpiar
                </button>

                <a href="<?php echo SERVER_URL; ?>" id="a_cancel" class="btn btn-default btn-danger faa-parent animated-hover">
                    <i class="fa fa-times faa-ring fa-fast"></i>
                    Cancelar  
                </a>

            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div id="div_profile_image">
            <img id="img_profile_image" class="img-thumbnail" src="<?php echo $image_path; ?>">
            <hr>
            <input type="file" id="fl_image" name="image_file"  accept="image/*"><br/>
        </div>

    </div>
</div>
