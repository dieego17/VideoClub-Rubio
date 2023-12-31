<?php
   
    include '../pages/inicioSesion.php';

    // Verifica si la sesión está activa y si el usuario es administrador
    if (!(isset($_SESSION['user']) && $_SESSION['rol'] === 1)) {
        // Si el usuario no es administrador, cierra la sesión y redirige a la página de inicio de sesión
        session_unset();
        session_destroy();
        header("Location: ../index.php?error=3");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="es">
    <!-- INICIO HEAD -->
    <head>
        <meta charset="UTF-8">
        <title>INICIO - VIDEOCLUB RUBIO</title>
        <link rel="shortcut icon" href="../assets/images/logo.jpeg" type="image/x-icon">
        <!-- Link to Bootstrap CSS library hosted on a CDN with integrity and crossorigin attributes -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <!-- LINK CSS -->
        <link rel="stylesheet" href="../css/inicio.css">
        <link rel="stylesheet" href="../css/inicioAdmin.css">
        <link rel="stylesheet" href="../css/header.css">
        <!-- link para favicons -->
    <script src="https://kit.fontawesome.com/3ed6284a33.js" crossorigin="anonymous"></script>
    </head>
    <!-- FIN HEAD -->

    <!-- INICIO BODY -->
    <body>
        <!-- HEADER -->
        <header class="header">
            <nav class="header__nav navbar navbar-expand-lg">
                <div class="container contenedor__nav">
                    <a class="navbar-brand" href="../pages/inicioAdmin.php">
                        <img class="header__img" src="../assets/images/titulo.png" alt="">
                        <p class="header__link">VideoClub Rubio</p>
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="contenedor__ul collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav d-flex me-auto mb-2 mb-lg-0">
                        </ul>
                        <div class="contenedor__icon">
                            <form class="d-flex" role="search">
                                <a class="btn__icon btn" href="../pages/cerrarSesion.php" target="target">CERRAR SESIÓN</a>
                            </form>
                        </div>
                    </div>
                </div>
            </nav>
        </header>
        <!-- FIN DEL HEADER -->
        <div class="contenedor div__admin">
            <div class="container__text">
                <h1 class="principal__title">Bienvenido/a <?php echo ucfirst($name) ?></h1>
                <?php
                    if(isset($_COOKIE['ultimaVez'])){
                        echo "<p class='text__fecha'>Tu última visita fue ".$_COOKIE['ultimaVez']."</p>";
                    }else{
                        echo "<p class='text__fecha'>Esta es tu primera visita</p>";
                    }
                ?>
            </div>
            <div class="container__button">
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModalAñadir">
                    Añadir Nueva Pelicula
                </button>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="exampleModalAñadir" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel14">Añadir Nueva Pelicula</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="form__section row g-3 needs-validation" method="POST" action="../pages/crearPelicula.php">
                                <div class="col-md-12 container__input">
                                    <label class="form__label">Título</label>
                                </div>
                                <div class="col-md-12 container__input">
                                    <input type="text" class="form__input" name="tituloPelicula" placeholder="Título">
                                </div>
                                <div class="col-md-12 container__input">
                                    <label class="form__label">Género</label>
                                </div>
                                <div class="col-md-12 container__input">
                                    <input type="text" class="form__input" name="generoPelicula" placeholder="Género">
                                </div>
                                <div class="col-md-12 container__input">
                                    <label class="form__label">País</label>
                                </div>
                                <div class="col-md-12 container__input">
                                    <input type="text" class="form__input" name="paisPelicula" placeholder="País">
                                </div>
                                <div class="col-md-12 container__input">
                                    <label class="form__label">Año</label>
                                </div>
                                <div class="col-md-12 container__input">
                                    <input type="text" class="form__input" name="anyoPelicula" placeholder="Año">
                                </div>
                                <div class="col-md-12 container__input">
                                    <label class="form__label">Cartel</label>
                                </div>
                                <div class="col-md-12 container__input">
                                    <input type="text" class="form__input" name="cartelPelicula" placeholder="titanic.jpg">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-danger">Confirmar</button>
                                </div>
                            </form>
                        </div>
                        
                    </div>
                </div>
            </div>        
            <!-- INICIO SECTION -->
            <div class="reservas__section">
                <!-- INICIO TABLA -->
                <table class="table">
                    <thead>
                        <tr>
                            <td class="th__table">Acciones</td>
                            <td class="th__table">Título</td>
                            <td class="th__table">Género</td>
                            <td class="th__table">País</td>
                            <td class="th__table">Año</td>
                            <td class="th__table">Cartel</td>
                            <td class="th__table">Reparto</td>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $id = 0;
                            $peliculas = consultaPeliculas();
                            if (count($peliculas) > 0) {
                                foreach ($peliculas as $pelicula) {
                                    $id++; // Incremento el id para que al pulsar en uno de los modales detecte el correcto
                                    $modalEliminarID = 'exampleModalEliminar_' . $id;
                                    $modalEditarID = 'exampleModalEditar_' . $id;
                                    
                                    $exampleModalLabelEliID = 'exampleModalLabelEliminar_' . $id;
                                    $exampleModalLabelEdiID = 'exampleModalLabelEditar_' . $id;
                                    
                                    echo "<tr>";
                                    echo '<td class="th__info">
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#'.$modalEliminarID.'">
                                          <i class="fa-solid fa-x eliminar__icon"></i>
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="'.$modalEliminarID.'" tabindex="-1">
                                          <div class="modal-dialog">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="'.$exampleModalLabelEliID.'">Eliminar Película</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                              </div>
                                              <div class="modal-body">
                                                ¿Esta seguro que quiere elimanar '.$pelicula->getTitulo().'? Si esta seguro pulse confirmar, si no, 
                                                pulse cancelar.
                                              </div>
                                              <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                <a href="../pages/eliminarPelicula.php?id=' . $pelicula->getId() . '" class="btn btn-danger">Confirmar</a>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                        
                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#'.$modalEditarID.'">
                                          <i class="fa-solid fa-pen eliminar__icon"></i>
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="'.$modalEditarID.'" tabindex="-1">
                                          <div class="modal-dialog">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="'.$exampleModalLabelEdiID.'">Modificar Película: '.$pelicula->getTitulo().'</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                              </div>
                                              <div class="modal-body">
                                                <form class="form__section row g-3 needs-validation" method="POST" action="../pages/modificarPelicula.php?modificarPeli='.$pelicula->getId().'">
                                                    <div class="col-md-12 container__input">
                                                      <label class="form__label">Título</label>
                                                    </div>
                                                    <div class="col-md-12 container__input">
                                                      <input type="text" class="form__input" name="tituloPelicula" placeholder="Título">
                                                    </div>
                                                    <div class="col-md-12 container__input">
                                                      <label class="form__label">Género</label>
                                                    </div>
                                                    <div class="col-md-12 container__input">
                                                      <input type="text" class="form__input" name="generoPelicula" placeholder="Género">
                                                    </div>
                                                    <div class="col-md-12 container__input">
                                                      <label class="form__label">País</label>
                                                    </div>
                                                    <div class="col-md-12 container__input">
                                                      <input type="text" class="form__input" name="paisPelicula" placeholder="País">
                                                    </div>
                                                    <div class="col-md-12 container__input">
                                                      <label class="form__label">Año</label>
                                                    </div>
                                                    <div class="col-md-12 container__input">
                                                      <input type="text" class="form__input" name="anyoPelicula" placeholder="Año">
                                                    </div>
                                                    <div class="col-md-12 container__input">
                                                      <label class="form__label">Cartel</label>
                                                    </div>
                                                    <div class="col-md-12 container__input">
                                                      <input type="text" class="form__input" name="cartelPelicula" placeholder="titanic.jpg">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                        <button type="submit" class="btn btn-danger">Confirmar</button>
                                                    </div>
                                                </form>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                    </td>';
                                    echo "<td class='th__info'>" . $pelicula->getTitulo() . "</td>";
                                    echo "<td class='th__info'>" . $pelicula->getGenero() . "</td>";
                                    echo "<td class='th__info'>" . $pelicula->getPais() . "</td>";
                                    echo "<td class='th__info'>" . $pelicula->getAnyo() . "</td>";
                                    echo "<td> <img class='img__act' alt='' src='../assets/images/" . $pelicula->getCartel() . "'> </td>";

                                    $actores = consultaActores($pelicula);
                                    if (count($actores) > 0) {
                                        foreach ($actores as $actor) {
                                            echo "<td class='th__info'><img class='img__act' alt='' src='../assets/images/". $actor->getFotografia() ."'><br><br>".
                                                    $actor->getNombre() . " " . $actor->getApellidos() . "</td>";
                                        }
                                        
                                    } else {
                                        echo "<td class='th__info'>No hay actores</td>";
                                    }
                                    echo "</tr>";
                                    
                                }
                            } else {
                                echo "<tr>";
                                echo "<th scope='row' colspan='8'>No hay ninguna película</th>";
                                echo "</tr>";
                            }
                            ?>

                </table>
                <!-- FIN TABLA -->
            </div>
            <!-- FIN SECTION -->
            <!-- ACTORES PARO -->
            <h2 class="principal__title">Actores en Paro</h2>
            <div class="container__paro">
                <?php
                    $actoresParo = consultaActoresParo();
                    if (count($actoresParo) > 0) {
                        foreach ($actoresParo as $actor){
                            echo "<div class='actores__img'>";
                                echo "<img class='img__act' alt='' src='../assets/images/".$actor->getFotografia() ."'><br>";
                                echo $actor->getNombre()." ".$actor->getApellidos()."<br>";
                            echo "</div>";
                        }
                    }
                ?>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>
    <!-- FIN BODY -->
</html>

