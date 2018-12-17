<?php

    session_start();

    include_once 'app/config.inc.php';
    include_once CONNECTION_URL;
    
    include_once USER_REPOSITORY_URL;
    include_once SESSION_CONTROL_URL;

    // Abro la conexión
    Connection::open_connection();

    // Cuento la cantidad de usuarios registrados
    $counterUsers = UserRepository::count_all_the_users(Connection::get_connection());

?>

<!-- Navigation Bar Begin -->
<nav id="nav_top" class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">

        <a class="navbar-brand" href="<?php echo SERVER_URL; ?>">Navbar de Prueba</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="nav navbar-nav mr-auto">

                <li class="nav-item">
                    <a class="nav-link faa-parent animated-hover" href="<?php echo POSTS_PAGE_URL; ?>">
                        <span class="fa fa-list fa-1x faa-horizontal fa-fast" aria-hidden="true"></span>
                        Entradas<span class="sr-only">(current)</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link faa-parent animated-hover" href="<?php echo FAVORITS_PAGE_URL; ?>">
                        <span class="fa fa-star fa-1x faa-spin fa-fast" aria-hidden="true"></span>
                        Favoritos
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link faa-parent animated-hover" href="<?php echo AUTHORS_PAGE_URL; ?>">
                        <i class="fa fa-registered fa-1x faa-pulse fa-fast" aria-hidden="true"></i>
                        Autores
                    </a>
                </li>

                <!--                                    <li class="nav-item dropdown">
                                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            Dropdown
                                                        </a>
                                                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                            <a class="dropdown-item" href="#">Action</a>
                                                            <a class="dropdown-item" href="#">Another action</a>
                                                            <div class="dropdown-divider"></div>
                                                            <a class="dropdown-item" href="#">Something else here</a>
                                                        </div>
                                                    </li>-->

                <!--                                    <li class="nav-item">
                                                        <a class="nav-link disabled" href="#">Disabled</a>
                                                    </li>-->

            </ul>

            <ul class="nav navbar-nav navbar-right">


                <?php

                    //Verificamos si el usuario ha iniciado sesión o no
                    if (SessionControl::is_the_session_started())
//                    if (isset($_SESSION['user_firstname']))
                    { // Si el usaurio ya ha iniciado sesión...

                        ?>

                        <li class="nav-item">
                            <a class="nav-link faa-parent animated-hover" href="<?php echo USER_PROFILE_PAGE_URL; ?>">
                                <span class="fa fa-user fa-lg faa-pulse fa-fast" aria-hidden="true"></span><span> :</span>
                                <span class="" style="">
                                    <?php echo $_SESSION['user_firstname']; ?>
                                </span>
                            </a>
                        </li>




                        <li class="nav-item">
                            <a class="nav-link faa-parent animated-hover" href="<?php echo USER_LOGOUT_PAGE_URL; ?>">
                                <span class="fa fa-sign-out fa-1x faa-horizontal fa-fast" aria-hidden="true"></span>
                                Cerrar sesión<span class="sr-only">(current)</span>
                            </a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle faa-parent animated-hover" href="<?php echo MANAGER_PAGE_GENERIC_URL; ?>" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="fa fa-cog fa-1x  faa-spin fa-fast" aria-hidden="true"></span>
                                Administrar
                            </a>

                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                                <a class="dropdown-item faa-parent animated-hover" href="<?php echo MANAGER_PAGE_GENERIC_URL; ?>">
                                    <i class="fa fa-cogs fa-1x faa-ring fa-fast" aria-hidden="true"></i>
                                    Contenido Genérico
                                </a>

                                <div class="dropdown-divider"></div>

                                <a class="dropdown-item faa-parent animated-hover" href="<?php echo MANAGER_PAGE_POSTS_URL; ?>">
                                    <span class="fa fa-tasks fa-1x faa-ring fa-fast" aria-hidden="true"></span>
                                    Entradas
                                </a>
                                <a class="dropdown-item faa-parent animated-hover" href="<?php echo MANAGER_PAGE_COMMENTS_URL; ?>">
                                    <i class="fa fa-comments fa-1x faa-ring fa-fast" aria-hidden="true"></i>
                                    Comentarios
                                </a>

                                <a class="dropdown-item faa-parent animated-hover" href="<?php echo MANAGER_PAGE_FAVORITS_URL; ?>">
                                    <i class="fa fa-bookmark fa-1x faa-ring fa-fast" aria-hidden="true"></i>
                                    Favoritos
                                </a>

                                <div class="dropdown-divider"></div>

                                <a class="dropdown-item faa-parent animated-hover" href="<?php echo MANAGER_PAGE_USERS_URL; ?>">
                                    <i class="fa fa-users fa-1x faa-ring fa-fast" aria-hidden="true"></i>
                                    Usuarios
                                </a>

                            </div>
                        </li>

                        <?php

                    }
                    else
                    { // Si el usaurio aun no ha iniciado sesión...

                        ?>

                        <li class="nav-item">
                            <a class="nav-link faa-parent animated-hover" href="#">
                                <span class="fa fa-user fa-lg faa-pulse fa-fast" aria-hidden="true"></span><span> :</span>
                                <span class="" style="">
                                    <?php

                                    echo $counterUsers;

                                    ?>
                                </span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link faa-parent animated-hover" href="<?php echo USER_LOGIN_PAGE_URL; ?>">
                                <span class="fa fa-sign-in fa-1x faa-horizontal fa-fast" aria-hidden="true"></span>
                                <!--<i class="fa fa-filter fa-1x faa-horizontal fa-fast" aria-hidden="true"></i>-->
                                Iniciar sesión<span class="sr-only">(current)</span>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a class="nav-link faa-parent animated-hover" href="<?php echo USER_REGISTRATION_PAGE_URL; ?>">
                                <span class="fa fa-user-plus fa-1x faa-pulse fa-fast" aria-hidden="true"></span>
                                Registrarse<span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <?php

                    }

                ?>


            </ul>

            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-dark my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>
<!-- Navigation Bar End -->

<!-- Jumbotron Begin -->
<div class="container-fluid">
    <div class="jumbotron">
        <h1>Blog de Reinier</h1>
        <p>Blog dedicado a la programación y al desarrollo</p>
    </div>
</div>
<!-- Jumbotron End -->