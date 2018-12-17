<fieldset>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-12 input-group">
            <div class="input-group-addon col-md-1 login-icon-md-1">
                <i class="fa fa-key"></i>
            </div>
            <input type="password" id="txt_user_password_1" class="form-control col-md-9" placeholder="Nueva contraseña" name="user_password_1" required <?php echo $rewrite_password_validator -> show_user_password1(); ?>>
        </div>
        <div class="col-md-12">
            <?php $rewrite_password_validator -> show_error_user_password1(); ?>
        </div>
        <input type="hidden" id="hddn_user_id" name="user_id" value="<?php echo $user_id; ?>">
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-12 input-group">
            <div class="input-group-addon col-md-1 login-icon-md-1">
                <i class="fa fa-key"></i>
            </div>
            <input type="password" id="txt_user_password_2" class="form-control col-md-9" placeholder="Repita la nueva contraseña" name="user_password_2" required <?php echo $rewrite_password_validator -> show_user_password2(); ?>>
        </div>
        <div class="col-md-10">
            <?php $rewrite_password_validator -> show_error_user_password2(); ?>
        </div>
    </div>

    <div class="form-group">     
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" id="btn_login" class="btn btn-default btn-lg btn-success btn-block faa-parent animated-hover" name="change_password">
                <i class="fa fa-sign-in fa-1x faa-horizontal fa-fast"></i>
                Cambiar contraseña
            </button>
            <br>

            <p class="text-center">
                ¿Nuevo miembro? <a href=" <?php echo USER_REGISTRATION_PAGE_URL; ?>" class="no-decoration">Regístrese</a><br>
                ¿Olvidó su contraseña? <a href="<?php echo PASSWORD_RECOVER_PAGE_URL ?>" class="no-decoration">Recupérela</a>
            </p>

        </div>
    </div>

</fieldset>