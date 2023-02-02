<?php
    /**
     * This file displays the main page
     *
     * The header and footer partials are required, and the header is created with the title "BookARoom"
     * Have a header with a nav bar and a login icon, if there is an user logged, the icon change to a user, and if user is admin, the "Mi cuenta" change to "Panel de administrador"
     * The page also have a gallery with the different types of rooms available
     * 
     * The footer is also created
     */
    require_once 'components/header.php';
    require_once 'components/footer.php';
    
    App\Views\Components\createHeader("BookARoom");
?>
        <header class="vh-100">
            <nav class="navbar navbar-expand-lg navbar-light bg-white">
                <div class="container-fluid">
                    <div class="logo d-flex align-items-center">
                        <img src="../public/build/media/logo/favicon.png" alt="logo">
                        <h2 class="mb-0 d-sm-block d-none">Book<span>A</span>Room</h2>
                    </div>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu" aria-bs-controls="menu" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div class="nav-content collapse navbar-collapse d-flex justify-content-end" id="menu">
                        <ul class="navbar-nav mb-2 mb-lg-0 d-flex justify-content-center align-items-center gap-3">
                            <li class="nav-item active">
                                <a class="nav-link" aria-current="page" href="#">Inicio</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="booking">Reserva</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="contact">Contacto</a>
                            </li>
                            <li class="nav-item">
                                <?php if(isset($_SESSION['login'])) : ?>
                                    <a class="nav-link d-flex align-items-center dropdown-toggle" href="userPanel" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><span class="material-icons">account_circle</span></a>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <?php if($_SESSION['login']['admin']) : ?>
                                            <li>
                                                <a class="dropdown-item" href="admin">Panel de administrador</a>
                                            </li>
                                        <?php else : ?>
                                            <li>
                                                <a class="dropdown-item" href="userPanel">Mi cuenta</a>
                                            </li>
                                        <?php endif; ?>
                                        <li>
                                            <a class="dropdown-item" href="logout">Log out</a>
                                        </li>
                                    </ul>
                                <?php else : ?>
                                    <a class="nav-link d-flex align-items-center" href="login"><span class="material-icons">login</span></a>
                                <?php endif; ?>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div id="banner" class="p-5 text-center bg-image d-flex justify-content-center align-items-center">
                <div class="mask" style="background-color: rgba(0, 0, 0, 0.7);">
                    <div class="d-flex justify-content-center align-items-center h-100">
                        <div class="text-white">
                            <h1 class="mb-3">Reserva con <span class="font-italic">Book A Room</span></h1>
                            <h5 class="mb-4">Reserve habitaciones de hotel al instante con BookARoom y relájese con estilo sin importar dónde se encuentre.</h5>
                            <a class="btn btn-outline-light btn-lg m-2" href="https://www.youtube.com/watch?v=c9B4TPnak1A" role="button" rel="nofollow" target="_blank">¡Reserva ya!</a>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <main>
            <section class="py-5 text-center container">
            <div class="row py-lg-5">
                <div class="col-lg-6 col-md-8 mx-auto">
                    <h1 class="fw-light">Empiece a explorar</h1>
                    <p class="lead text-muted">Bienvenido a nuestra web, donde le ofrecemos la mejor experiencia en reservas de habitaciones de hotel. Estamos aquí para hacer de su estadía un momento inolvidable. ¡Haga su reserva ahora y sienta la comodidad de ser nuestro invitado!</p>
                    <p>
                        <a href="#album" class="btn btn-primary my-2">¡Empiece a elegir!</a>
                    </p>
                </div>
            </div>
            </section>
            <div id="album" class="album py-5 bg-light">
                <div class="container">
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                        <div class="col">
                            <div class="card shadow-sm">
                                <div class="img-header">
                                    <img src="../public/build/media/room1.jpg" alt="habitación premium">
                                </div>
                                <div class="card-body">
                                    <h5>Habitación premium</h5>
                                    <p class="card-text">Una habitación lujosa con acabados de alta calidad y elementos de decoración elegante. Incluye una cama king size, escritorio, televisión de pantalla plana y un baño privado con artículos de aseo gratuitos.</p>
                                    <p class="max-capacity"><span class="material-icons">family_restroom</span> 2 personas.</p>
                                    <div class="d-flex justify-content-end">
                                        <a href="booking" class="btn btn-sm btn-outline-secondary">Ver</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card shadow-sm">
                                <div class="img-header">
                                    <img src="../public/build/media/room2.jpg" alt="habitación premium">
                                </div>
                                <div class="card-body">
                                    <h5>Habitación deluxe</h5>
                                    <p class="card-text">Una habitación amplia y elegante con una cama king size, televisión de pantalla plana, escritorio y baño privado con artículos de aseo gratuitos.</p>
                                    <p class="max-capacity"><span class="material-icons">family_restroom</span> 2 personas.</p>
                                    <div class="d-flex justify-content-end">
                                        <a href="booking" class="btn btn-sm btn-outline-secondary">Ver</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card shadow-sm">
                                <div class="img-header">
                                    <img src="../public/build/media/room3.jpg" alt="habitación premium">
                                </div>
                                <div class="card-body">
                                    <h5>Habitación doble</h5>
                                    <p class="card-text">Una habitación cómoda con dos camas individuales, escritorio, televisión de pantalla plana y baño compartido.</p>
                                    <p class="max-capacity"><span class="material-icons">family_restroom</span> 2 personas.</p>
                                    <div class="d-flex justify-content-end">
                                        <a href="booking" class="btn btn-sm btn-outline-secondary">Ver</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="card shadow-sm">
                                <div class="img-header">
                                    <img src="../public/build/media/room4.jpg" alt="habitación premium">
                                </div>
                                <div class="card-body">
                                    <h5>Habitación familiar</h5>
                                    <p class="card-text">Una habitación espaciosa con una cama king size y dos camas individuales, escritorio, televisión de pantalla plana y baño privado con artículos de aseo gratuitos.</p>
                                    <p class="max-capacity"><span class="material-icons">family_restroom</span> 4 personas.</p>
                                    <div class="d-flex justify-content-end">
                                        <a href="booking" class="btn btn-sm btn-outline-secondary">Ver</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card shadow-sm">
                                <div class="img-header">
                                    <img src="../public/build/media/room5.jpg" alt="habitación premium">
                                </div>
                                <div class="card-body">
                                    <h5>Habitación doble con vistas</h5>
                                    <p class="card-text">Una habitación con dos camas individuales, escritorio, televisión de pantalla plana y baño compartido con vistas panorámicas a la ciudad o al paisaje.</p>
                                    <p class="max-capacity"><span class="material-icons">family_restroom</span> 2 personas.</p>
                                    <div class="d-flex justify-content-end">
                                        <a href="booking" class="btn btn-sm btn-outline-secondary">Ver</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card shadow-sm">
                                <div class="img-header">
                                    <img src="../public/build/media/room6.jpg" alt="habitación premium">
                                </div>
                                <div class="card-body">
                                    <h5>Habitación familiar con vistas</h5>
                                    <p class="card-text">Una habitación con una cama king size y dos camas individuales, escritorio, televisión de pantalla plana y baño privado con vistas panorámicas a la ciudad o al paisaje.</p>
                                    <p class="max-capacity"><span class="material-icons">family_restroom</span> 4 personas.</p>
                                    <div class="d-flex justify-content-end">
                                        <a href="booking" class="btn btn-sm btn-outline-secondary">Ver</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <section class="">
            <footer class="bg-dark text-white text-center text-md-start">
                <div class="container p-4">
                    <div class="row d-flex align-items-center">
                        <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
                            <h5 class="text-uppercase">Book A Room</h5>
                            <p>
                            Llegamos a millones de viajeros en 90 sitios web locales.
                            </p>
                            <section class="mb-4">
                            <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"
                                ><i class="fab fa-twitter"></i
                            ></a>
                            <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"
                                ><i class="fab fa-instagram"></i
                            ></a>
                            <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"
                                ><i class="fab fa-linkedin-in"></i
                            ></a>
                            </section>
                        </div>
                        <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                            <ul class="list-unstyled mb-0">
                                <li>
                                    <a href="#!" class="text-white">Sobre nosotros</a>
                                </li>
                                <li>
                                    <a href="#!" class="text-white">Habitaciones</a>
                                </li>
                                <li>
                                    <a href="#!" class="text-white">Términos y condiciones</a>
                                </li>
                                <li>
                                    <a href="#!" class="text-white">Política de privacidad</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                            <h5 class="text-uppercase">Contáctanos</h5>
                            <ul class="list-unstyled mb-0">
                                <li>
                                <span class="material-icons">call</span><p class="text-white">+34 942607987</p>
                                </li>
                                <li>
                                <span class="material-icons">email</span><p class="text-white">support@bookaroom.com</p>
                                </li>
                                <li>
                                <span class="material-icons">room</span><p class="text-white">Jardines de España, 29, 23920, Pozo Alcón (Jaén)</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
                    © 2023 Copyright:
                    <a class="text-white" href="https://mdbootstrap.com/">Book A Room</a>
                </div>
            </footer>
        </section>
<?php
    App\Views\Components\createFooter();
?>
