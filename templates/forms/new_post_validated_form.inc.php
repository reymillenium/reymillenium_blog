<fieldset>

    <div class="form-group">
        <div class="input-group col-md-12">
            <div class="input-group-addon">
                <i class="fa fa-tag" title="Título de la entrada"></i>
            </div>
            <input type="text" id="txt_post_title" class="form-control" placeholder="Título de la entrada" name="post_title" <?php $new_post_validator -> show_focused_post_title(); ?> <?php $new_post_validator -> show_post_title(); ?>>
        </div>
        <div class="col-md-12">
            <?php $new_post_validator -> show_error_post_title(); ?>
        </div>
    </div>

    <div class="form-group">
        <div class="input-group col-md-12">
            <div class="input-group-addon">
                <i class="fa fa-external-link" title="URL de la entrada"></i>
            </div>
            <input type="text" id="txt_post_url" class="form-control" placeholder="URL de la entrada" name="post_url" <?php $new_post_validator -> show_focused_post_url(); ?> <?php $new_post_validator -> show_post_url(); ?>>
        </div>
        <div class="col-md-12">
            <?php $new_post_validator -> show_error_post_url(); ?>
        </div>
    </div>

    <div class="form-group">
        <div class="input-group col-md-12">
            <label id="lbl_post_text" for="post_text"><strong>Texto:</strong></label>
        </div>

        <div class="input-group col-md-12">
            <textarea id="txta_post_text" name="post_text" class="form-control" rows="12" placeholder="" <?php $new_post_validator -> show_focused_post_text(); ?> <?php $new_post_validator -> show_post_text(); ?>></textarea>
        </div>

        <div class="col-md-12">
            <?php $new_post_validator -> show_error_post_text(); ?>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-md-12">
            <div class="checkbox">
                <label id="lbl_post_is_active"><input type="checkbox" id="chbx_post_is_active" name="post_is_active" value="true" <?php $new_post_validator -> show_checked_post_is_active(); ?>> Entrada válida</label>
            </div>
        </div>
    </div>

    <div class="form-group">     
        <div class="col-sm-offset-2 col-sm-10">

            <button type="submit" id="btn_save_post" class="btn btn-default btn-success faa-parent animated-hover" name="save_post">
                <i class="fa fa-sign-in faa-horizontal fa-fast"></i>
                Guardar
            </button>

            <button type="reset" id="btn_eraser" class="btn btn-default btn-secondary faa-parent animated-hover">
                <i class="fa fa-eraser faa-ring fa-fast"></i>
                Limpiar
            </button>

            <a href="<?php echo MANAGER_PAGE_POSTS_URL ?>" class="btn btn-default btn-danger faa-parent animated-hover">
                <i class="fa fa-times faa-ring fa-fast"></i>
                Cancelar
            </a>

        </div>
    </div>

</fieldset>