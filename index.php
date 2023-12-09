<!DOCTYPE html>

<html lang="es">
    <!-- INICIO HEAD -->
    <head>
        <meta charset="UTF-8">
        <title>LOG-IN - VIDEOCLUB RUBIO</title>
        <link rel="shortcut icon" href="./assets/images/logo.jpeg" type="image/x-icon">
        <!-- Link to Bootstrap CSS library hosted on a CDN with integrity and crossorigin attributes -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <!-- LINK CSS -->
        <link rel="stylesheet" href="./css/style.css">
        <link rel="stylesheet" href="./css/header.css">
        <!-- link para favicons -->
    <script src="https://kit.fontawesome.com/3ed6284a33.js" crossorigin="anonymous"></script>
    </head>
    <!-- FIN HEAD -->

    <!-- INICIO BODY -->
    <body>
        <!-- CONTAINER -->
        <div class="container">
            <main class="main">
                <section class="row section__form">
                    <article class="article__form">
                        <img class="img__log" src="./assets/images/logo.jpeg" alt="">
                    </article>
                    <!-- INICIO FORM -->
                    <form class="form__section row g-3 needs-validation" method="POST" action="">
                        <div class="col-md-12 container__input">
                          <label class="form__label"><i class="fa-solid fa-user"></i></label>
                          <input type="text" class="form__input" name="usuario" placeholder="Usuario">
                        </div>
                        <div class="col-md-12 container__input">
                          <label class="form__label"><i class="fa-solid fa-lock"></i></label>
                          <input type="password" class="form__input" name="contraseña" placeholder="Contraseña">
                        </div>
                        <div class="col-12 container__button">
                          <button class="btn btn__inicio" type="submit">Iniciar Sesión</button>
                        </div>
                    </form>
                    <!-- FIN FORM -->
                </section>
            </main>
        </div>
    </body>
    <!-- FIN BODY -->
</html>
