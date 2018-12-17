<fieldset>
    <script type="text/javascript">

        $(document).ready(function () {

            var collapseItem = localStorage.getItem('div_advanced_search');

            if (collapseItem) {
                // Muestro el accordion
                $(collapseItem).collapse('show');
            } else
            { // Si no está la cookie
                // Escondo el Accordion
                $(collapseItem).collapse('hide');
            }




            // Especifico en evento OnClick para el enlace del toogle del Accordion
            $('#a_advanced_search').click(function () {

                // Defino una variable enlazada a una cookie
                var collapseItem = localStorage.getItem('div_advanced_search');

                // Verifico si está o no la cookie almacenada
                if (collapseItem) { // Si está la cookie guardada (ya se pulsó el enlace antes para abrirlo)

                    // Borro la cookie
                    localStorage.removeItem('div_advanced_search');

                } else
                { // Si no aparece la cookie (1ra vez que se entra a la página o si se borró antes)

                    //Almaceno el id del elemento colapsable
                    localStorage.setItem('div_advanced_search', $(this).attr('href'));
                }



            });

        });
    </script>

    <div class="form-group">
        <div class="input-group col-md-12">
            <input type="search" name="search_term" class="form-control" placeholder="Type your search" required <?php echo $search_validator->show_focused_search_term(); ?>  <?php echo isset($search_term) ? 'value="' . $search_term . '"' : ''; ?>>
        </div>

        <div class="col-md-12">
            <?php $search_validator -> show_error_search_term(); ?>
        </div>
    </div>

    <div class="form-group">
        <div class="input-group col-md-12">
            <a id="a_advanced_search" class="accordion-toggle" data-toggle="collapse" href="#div_advanced_search">
                <span class="fa fa-graduation-cap" aria-hidden="true"></span>
                Búsqueda Avanzada
            </a>   
        </div>
    </div>

    <div id="div_advanced_search" class="accordion-body collapse in">
        <div class="card-body">
            <p>Buscar en los siguientes campos</p>

            <label class="checkbox-inline">
                <input type="checkbox" name="fields[]" value="post_title" <?php echo $search_validator -> show_checked_post_title($fields); ?>> Título &nbsp 
            </label>
            <label class="checkbox-inline">
                <input type="checkbox" name="fields[]" value="post_text" <?php echo $search_validator -> show_checked_post_text($fields); ?>> Contenido &nbsp 
            </label>
            <label class="checkbox-inline">
                <input type="checkbox" name="fields[]" value="post_author_id"  <?php echo $search_validator -> show_checked_post_author_id($fields); ?>> Autor &nbsp
            </label>

            <hr>

            <p>Ordenar por:</p>
            <label class="radio-inline">
                <input type="radio" name="post_date_order" value="descending" <?php echo $search_validator -> show_checked_descending($post_date_order); ?>>Entradas más recientes
            </label>
            <label class="radio-inline">
                <input type="radio" name="post_date_order" value="ascending" <?php echo $search_validator -> show_checked_ascending($post_date_order); ?>>Entradas más antiguas
            </label>
            <hr>

        </div>
    </div>

    <div class="form-group">   
        <div class="input-group col-md-12">
            <button type="submit" id="btn_search" name="search" class="form-control btn btn-default btn-success faa-parent animated-hover">
                <i class="fa fa-search  faa-ring fa-fast" aria-hidden="true"></i>&ensp;Buscar
            </button>
        </div>
    </div>

</fieldset>
