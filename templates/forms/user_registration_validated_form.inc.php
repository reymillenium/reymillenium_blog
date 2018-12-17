<div class="form-group">
    <div class="col-sm-offset-2 col-md-8 input-group">
        <div class="input-group-addon col-md-1">
            <i class="fa fa-address-card"></i>
        </div>
        <input type="text" id="txt_user_firstname" class="form-control col-md-8" placeholder="Nombre" name="user_firstname"  <?php $validator -> show_user_firstname(); ?>>
    </div>
    <div class="col-md-12">
        <?php $validator -> show_error_user_firstname(); ?>
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-2 col-md-8 input-group">
        <div class="input-group-addon col-md-1">
            <i class="fa fa-address-card"></i>
        </div>
        <input type="text" id="txt_user_secondname" class="form-control col-md-8" placeholder="Segundo nombre" name="user_secondname" <?php $validator -> show_user_secondname(); ?>>
    </div>
    <div class="col-md-12">
        <?php $validator -> show_error_user_secondname(); ?>
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-2 col-md-8 input-group">
        <div class="input-group-addon col-md-1">
            <i class="fa fa-address-card"></i>
        </div>
        <input type="text" id="txt_user_lastname" class="form-control col-md-8" placeholder="Apellidos" name="user_lastname" <?php $validator -> show_user_lastname(); ?>>
    </div>
    <div class="col-md-12">
        <?php $validator -> show_error_user_lastname(); ?>
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-2 col-md-8 input-group">
        <div class="input-group-addon col-md-1">
            <i class="fa fa-envelope"></i>
        </div>
        <input type="email" id="txt_user_email" class="form-control col-md-8" placeholder="Email" name="user_email" <?php $validator -> show_user_email(); ?>>
    </div>
    <div class="col-md-12">
        <?php $validator -> show_error_user_email(); ?>
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-2 col-md-8 input-group">
        <div class="input-group-addon col-md-1">
            <i class="fa fa-key"></i>
        </div>
        <input type="password" id="txt_user_password1" class="form-control col-md-8" placeholder="Password" name="user_password1" <?php $validator -> show_user_password1(); ?>>
    </div>
    <div class="col-md-12">
        <?php $validator -> show_error_user_password1(); ?>
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-2 col-md-8 input-group">
        <div class="input-group-addon col-md-1">
            <i class="fa fa-key"></i>
        </div>
        <input type="password" id="txt_user_password2" class="form-control col-md-8" placeholder="Repita su password" name="user_password2" <?php $validator -> show_user_password2(); ?>>
    </div>
    <div class="col-md-12">
        <?php $validator -> show_error_user_password2(); ?>
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-2 col-md-8 input-group">
        <div class="input-group-addon col-md-1">
            <i class="fa fa-phone"></i>
        </div>
        <input type="text" id="txt_user_phone" class="form-control col-md-8" placeholder="Teléfono" name="user_phone" maxlength="10" <?php $validator -> show_user_phone(); ?>>
    </div>
    <div class="col-md-12">
        <?php $validator -> show_error_user_phone(); ?>
    </div>
</div>

<div class="form-group">
    <!--<label id="lbl_user_gender" class="control-label col-sm-2" for="user_gender">Género:</label>-->
    <div class="col-md-8">  

        <select id="slct_user_gender" class="form-control col-md-9" name="user_gender" title="Choose one of the following...">
            <option value="Male" <?php $validator -> show_user_gender_male(); ?>>&#xf222; Masculino </option>
            <option value="Female" <?php $validator -> show_user_gender_female(); ?>>&#xf221; Femenino </option>
            <option value="Freak" <?php $validator -> show_user_gender_freak(); ?>>&#xf224; Freak</option>
        </select>
    </div>
    <div class="col-md-12">
        <?php $validator -> show_error_user_gender(); ?>
    </div>
</div>

<div class="form-group">
    <!--<label id="lbl_user_kind" class="control-label col-sm-2" for="user_kind">Tipo:</label>-->
    <div class="col-md-8">  

        <select id="slct_user_kind" class="form-control col-md-9" name="user_kind">
            <option value="Administrator" <?php $validator -> show_user_kind_administrator(); ?>>&#xf19d; Administrador</option>
            <option value="Operator" <?php $validator -> show_user_kind_operator(); ?>>&#xf007; Operador</option>
            <option value="Guest" <?php $validator -> show_user_kind_guest(); ?>>&#xf183; Invitado</option>
        </select>
    </div>
    <div class="col-md-12">
        <?php $validator -> show_error_user_kind(); ?>
    </div>
</div>

<br>

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