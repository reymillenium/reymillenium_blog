<fieldset>
    <div class="form-group">
        <div class="input-group col-md-12">
            <input type="search" name="search_term" class="form-control" placeholder="Type your search" required>
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
                <input type="checkbox" name="fields[]" value="post_title" checked> Título &nbsp 
            </label>
            <label class="checkbox-inline">
                <input type="checkbox" name="fields[]" value="post_text" checked> Contenido &nbsp 
            </label>
            <label class="checkbox-inline">
                <input type="checkbox" name="fields[]" value="post_author_id" > Autor &nbsp
            </label>

            <hr>

            <p>Ordenar por:</p>
            <label class="radio-inline">
                <input type="radio" name="post_date_order" value="descending" checked>Entradas más recientes
            </label>
            <label class="radio-inline">
                <input type="radio" name="post_date_order" value="ascending">Entradas más antiguas
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
