<fieldset>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-12 input-group">
            <div class="input-group-addon col-md-1 login-icon-md-1">
                <i class="fa fa-envelope"></i>
            </div>
            <input type="email" id="txt_user_email" class="form-control col-md-9" placeholder="Email" name="user_email" autofocus>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-12 input-group">
            <div class="input-group-addon col-md-1 login-icon-md-1">
                <i class="fa fa-key"></i>
            </div>
            <input type="password" id="txt_user_password" class="form-control col-md-9" placeholder="Contraseña" name="user_password">
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-12">
            <div class="checkbox">
                <!--<label><input type="checkbox" name="remember"> Remember me</label>-->
                <label id="lbl_destroy_session"><input type="checkbox" id="chbx_session" name="session" value="1"> Recordar mis datos (alargar sesión)</label>
            </div>
        </div>
    </div>

    <div class="form-group">     
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" id="btn_login" class="btn btn-default btn-lg btn-success btn-block faa-parent animated-hover" name="login">
                <i class="fa fa-sign-in fa-1x faa-horizontal fa-fast"></i>
                Entrar
            </button>
            <br>

            <p class="text-center">
                ¿Nuevo miembro? <a href=" <?php echo USER_REGISTRATION_PAGE_URL; ?>" class="no-decoration">Regístrese</a><br>
                ¿Olvidó su contraseña? <a href="<?php echo PASSWORD_RECOVER_PAGE_URL ?>" class="no-decoration">Recupérela</a>
            </p>
        </div>
    </div>

</fieldset>