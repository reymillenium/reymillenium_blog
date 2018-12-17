
<div id="div_left_column" class="col-md-4">

    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    <span class="fa fa-search" aria-hidden="true"></span>
                    Búsqueda
                </div>

                <div class="card-body">

                    <form role="form" method="POST" action="<?php echo SEARCH_PAGE_URL; ?>">

                        <?php

                            if (isset($_POST['search']))
                            { // Si el usuario pulsó el botón de Buscar dentro del formulario...
                                // Muestro el formulario de Búsqueda validado
                                include_once SEARCH_VALIDATED_FORM_URL;
                            }
                            else // El usuario recién acaba de entrar a la página de Búsqueda... (no pulsó el botón de Buscar)
                            {
                                // Muestro el formulario de Búsqueda vacío
                                include_once SEARCH_EMPTY_FORM_URL;
                            }

                        ?>
                      
                    </form>

                </div>
                <!--<div class="card-footer"></div>-->
            </div>
        </div>
    </div>
    <br>

    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    <!--                    <div class="card-title">
                                        </div>-->
                    <span class="fa fa-filter" aria-hidden="true"></span>
                    Filtro
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <input type="search" class="form-control" placeholder="Type your search"><br/>
                    </div>
                    <!--<button type="button" id="btn_search" class="btn btn-default">Search</button>-->
                    <button type="button" id="btn_filter" class="form-control"><span class="fa fa-search" aria-hidden="true"></span> Search</button>
                </div>

                <!--<div class="card-footer"></div>-->
            </div>

        </div>
    </div>
    <br>

    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header">
                    <span class="fa fa-calendar" aria-hidden="true"></span>
                    Archivos
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <input type="search" class="form-control" placeholder="Type your search"><br/>
                    </div>
                    <!--<button type="button" id="btn_search" class="btn btn-default">Search</button>-->
                    <button type="button" id="btn_files" class="form-control"><span class="fa fa-search" aria-hidden="true"></span> Search</button>
                </div>

                <!--<div class="card-footer"></div>-->
            </div>
        </div>
    </div>


</div>