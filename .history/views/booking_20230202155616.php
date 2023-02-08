<?php
    /**
     * This file displays the booking page where users can make a reservation
     *
     * The header and footer partials are required, and the header is created with the title "Signup"
     * The page have a single form which is used to get user information in order to log in 
     * The footer is also created
     */

    /**
     * Start session if there's no one
     */
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    require_once 'components/header.php';
    require_once 'components/footer.php';

    use App\Controllers\RoomsController;
    $roomTb = RoomsController::getRoomsList();
    
    App\Views\Components\createHeader("Reservas");
?>
    <div class="modal fade" id="bookRoom" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="max-width: 25vw;">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 id="modal-title2" class="modal-title m-auto update">Reservar habitación</h4>
                </div>
                <form action="booking" method="POST" role="form">
                    <div class="modal-body">
                        <div class="form-floating mb-4">
                            <input type="text" name="bookRoomNid" class="form-control" placeholder="" value='<?= $_SESSION['login']['nid'] ?? ''; ?>' />
                            <label for="bookRoomNid">DNI</label>
                        </div>
                        <div class="form-floating mb-4">
                            <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="bookRoomRId" required>
                                <?php 
                                    if(count($roomTb) > 0) :
                                ?>
                                <option value="noSel" selected disabled>Selecciona una habitación</option>
                                <?php
                                        foreach($roomTb as $roomRow) : 
                                ?>
                                            <option class="text-center" value='<?= $roomRow['id'] ?>'><?= $roomRow['room_type'] ?></option>
                                <?php 
                                        endforeach; 
                                    else :        
                                ?>
                                        <option value="noSel" selected disabled>No hay habitaciones disponibles</option>
                                <?php
                                    endif;
                                ?>
                            </select>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="date" name="bookRoomCheckIn" class="form-control" placeholder="" />
                            <label for="bookRoomCheckIn">Fecha de entrada</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="date" name="bookRoomCheckOut" class="form-control" placeholder="" />
                            <label for="bookRoomCheckOut">Fecha de salida</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary" name="bookRoomSubmit" value="">Reservar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <header>
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
    </header>

<main class="booking py-5 d-flex flex-column flex-wrap">
    <?php 
    if(count($roomTb) > 0) :
        foreach($roomTb as $roomRow) : 
    ?>
        <section>
            <div class="room-content">
                <div class="left-img">
                    <img src="../public/build/media/room<?= $roomRow['id']; ?>.jpg" alt="Habitación premium">
                </div>
                <div class="right-text px-5">
                    <h2><?= $roomRow['room_type']; ?></h2>
                    <p><?= $roomRow['description']; ?></p>
                    <p class="max-capacity"><span class="material-icons">family_restroom</span> <?= $roomRow['max_capacity']; ?> personas.</p>
                    <button type="button" class="btn btn-info text-white" data-bs-toggle="modal" data-bs-target="#bookRoom">Reservar</button>
                </div>
            </div>
        </section>
    <?php 
        endforeach; 
    endif;    
    ?>
</main>

<section class="footer">
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
