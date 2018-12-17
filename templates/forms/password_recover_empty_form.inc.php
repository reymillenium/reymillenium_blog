<fieldset>

    <p id="p_instructions" class="col-md-10 alert alert-info text-justify">
        Escribe la dirección de correo electrónico con el que te registraste. Te enviaremos un email 
        con el que podrás restablecer tu contraseña.
    </p>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-12 input-group">
            <div class="input-group-addon col-md-1 login-icon-md-1">
                <i class="fa fa-envelope"></i>
            </div>
            <input type="email" id="txt_user_email" class="form-control col-md-9" placeholder="Email" name="user_email" autofocus>
        </div>
    </div>

    <div class="form-group">     
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" id="btn_send_email" class="btn btn-default btn-lg btn-success btn-block faa-parent animated-hover" name="send_email">
                <i class="fa fa-sign-in fa-1x faa-horizontal fa-fast"></i>
                Enviar Email
            </button>
            <br>

            <p class="text-center">
                ¿Nuevo miembro? <a href=" <?php echo USER_REGISTRATION_PAGE_URL; ?>" class="no-decoration">Regístrese</a><br>
            </p>
        </div>
    </div>

</fieldset>