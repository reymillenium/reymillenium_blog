<div class="form-group">
    <div class="col-sm-offset-2 col-md-8 input-group">
        <div class="input-group-addon col-md-1">
            <i class="fa fa-address-card"></i>
        </div>
        <input type="text" id="txt_user_firstname" class="form-control col-md-8" placeholder="Nombre" name="user_firstname" autofocus>
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-2 col-md-8 input-group">
        <div class="input-group-addon col-md-1">
            <i class="fa fa-address-card"></i>
        </div>
        <input type="text" id="txt_user_secondname" class="form-control col-md-8" placeholder="Segundo nombre" name="user_secondname">
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-2 col-md-8 input-group">
        <div class="input-group-addon col-md-1">
            <i class="fa fa-address-card"></i>
        </div>
        <input type="text" id="txt_user_lastname" class="form-control col-md-8" placeholder="Apellidos" name="user_lastname">
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-2 col-md-8 input-group">
        <div class="input-group-addon col-md-1">
            <i class="fa fa-envelope"></i>
        </div>
        <input type="email" id="txt_user_email" class="form-control col-md-8" placeholder="Email" name="user_email">
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-2 col-md-8 input-group">
        <div class="input-group-addon col-md-1">
            <i class="fa fa-key"></i>
        </div>
        <input type="password" id="txt_user_password1" class="form-control col-md-8" placeholder="Password" name="user_password1">
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-2 col-md-8 input-group">
        <div class="input-group-addon col-md-1">
            <i class="fa fa-key"></i>
        </div>
        <input type="password" id="txt_user_password2" class="form-control col-md-8" placeholder="Repita su password" name="user_password2">
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-2 col-md-8 input-group">
        <div class="input-group-addon col-md-1">
            <i class="fa fa-phone"></i>
        </div>
        <input type="text" id="txt_user_phone" class="form-control col-md-8" placeholder="Teléfono" name="user_phone" maxlength="10">
    </div>
</div>

<div class="form-group">
    <!--<label id="lbl_user_gender" class="control-label col-sm-2" for="user_gender">Género:</label>-->
    <div class="col-md-8">  

        <select id="slct_user_gender" class="form-control col-md-9" name="user_gender" title="Choose one of the following...">
            <option value="Male">&#xf222; Masculino </option>
            <option value="Female">&#xf221; Femenino </option>
            <option value="Freak">&#xf224; Freak</option>
        </select>

    </div>
</div>

<div class="form-group">
    <!--<label id="lbl_user_kind" class="control-label col-sm-2" for="user_kind">Tipo:</label>-->
    <div class="col-md-8">  

        <select id="slct_user_kind" class="form-control col-md-9" name="user_kind">
            <option value="Administrator">&#xf19d; Administrador</option>
            <option value="Operator">&#xf007; Operador</option>
            <option value="Guest">&#xf183; Invitado</option>
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
    <div class="col-sm-offset-2 col-sm-10">

        <button type="submit" id="btn_register" class="btn btn-default btn-success faa-parent animated-hover" name="register">
            <i class="fa fa-sign-in faa-horizontal fa-fast"></i>
            Registrarse
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
