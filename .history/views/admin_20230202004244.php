<?php
    /**
     * This file displays the admin panel
     *
     * The header and footer partials are required, and the header is created with the title "Panel de administrador"
     * Have several modals for insert, update and delete; rooms can be inserted through a modal form as well as updated or deleted and users and reservations can be deleted or updated
     * The page have several tables that displays through loops the database queries of each table: rooms, booking and users
     */
    require_once 'components/header.php';
    require_once 'components/footer.php';
    
    use App\Controllers\UsersController;
    use App\Controllers\RoomsController;
    use App\Controllers\BookingController;
    use App\Models\Booking;

    App\Views\Components\createHeader("Panel de administrador");

    
    $customersTb = UsersController::getUsersList();
    $roomTb = RoomsController::getRoomsList();
    $bookingTb = BookingController::getBookingList();

?>
<div class="modal fade" id="add-room" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="max-width: 25vw;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="modal-title2" class="modal-title m-auto update">Añadir habitación</h4>
            </div>
            <form action="admin" method="POST" role="form">
                <div class="modal-body">
                    <div class="form-floating mb-4">
                        <input type="text" name="roomTypeSignUp" class="form-control" placeholder="Tipo de habitación"/>
                        <label for="roomTypeSignUp">Tipo de habitación</label>
                    </div>
                    <div class="form-floating mb-4">
                        <textarea class="form-control" name="roomDescriptionSignUp" placeholder="" style="height: 100px"></textarea>
                        <label for="roomDescriptionSignUp">Descripción</label>
                    </div>
                    <div class="form-floating mb-4">
                        <input type="number" name="maxCapacitySignUp" class="form-control" placeholder="Capacidad máxima"/>
                        <label for="maxCapacitySignUp">Capacidad máxima</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary" name="signUpRoom">Añadir</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php 
    if(!empty($customersTb)) :
        foreach($customersTb as $customersRow) : 
?>
        <div class="modal fade" id="deleteCustomers<?= $customersRow['nid']; ?>" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <h4 id="modal-title1" class="modal-title m-auto login">¡Atención!</h4>
                    </div>
                    <form action="admin" method="POST" role="form">
                        <div class="modal-body">
                            <div class="form-floating mb-4">
                                <p class="text-center fs-5">¿Está seguro que quiere eliminar al usuario <?= $customersRow['nid']; ?>?</p>
                                <input type="hidden" name="nidDel" value='<?= $customersRow['nid']; ?>'>
                            </div>
                        </div>
                        <div class="modal-footer d-flex justify-content-center">
                            <button type="button" class="btn btn-secondary mb-4" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" name="submitUserDel" class="btn btn-primary mb-4" data-bs-dismiss="modal">Eliminar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="updateCustomers<?= $customersRow['nid']; ?>" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="max-width: 25vw;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 id="modal-title2" class="modal-title m-auto update">Actualizar usuario</h4>
                    </div>
                    <form action="admin" method="POST" role="form">
                        <div class="modal-body">
                            <div class="form-floating mb-4">
                                <input type="text" name="nidUp" class="form-control" placeholder="" value='<?= $customersRow['nid']; ?>' />
                                <label for="nidUp">DNI</label>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="text" name="nameUp" class="form-control" placeholder="" value='<?= $customersRow['name']; ?>' />
                                <label for="nameUp">Nombre</label>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="text" name="surname1Up" class="form-control" placeholder="" value='<?= $customersRow['surname1']; ?>' />
                                <label for="surname1Up">Primer apellido</label>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="text" name="surname2Up" class="form-control" placeholder="" value='<?= $customersRow['surname2']; ?>' />
                                <label for="surname2Up">Segundo apellido</label>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="email" name="emailUp" class="form-control" placeholder="" value='<?= $customersRow['email']; ?>' />
                                <label for="emailUp">Email</label>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="text" name="telephoneUp" class="form-control" placeholder="" value='<?= $customersRow['telephone']; ?>' />
                                <label for="telephoneUp">Teléfono</label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary" name="submitUpUser" value="">Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
<?php 
        endforeach; 
    endif;
?>

<?php 
    if(!empty($roomTb)) :
        foreach($roomTb as $roomRow) : 
?>
    <div class="modal fade" id="deleteRoom<?= $roomRow['id']; ?>" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h4 id="modal-title1" class="modal-title m-auto text-white">¡Atención!</h4>
                </div>
                <form action="admin" method="POST" role="form">
                    <div class="modal-body">
                        <div class="form-floating mb-4">
                            <p class="text-center fs-5">¿Está seguro que quiere eliminar la habitación <?= $roomRow['id']; ?>?</p>
                            <input type="hidden" name="roomDel" value='<?= $roomRow['id']; ?>'>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <button type="button" class="btn btn-secondary mb-4" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" name="submitRoomDel" class="btn btn-primary mb-4" data-bs-dismiss="modal">Eliminar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="updateRoom<?= $roomRow['id']; ?>" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="max-width: 25vw;">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 id="modal-title2" class="modal-title m-auto update">Actualizar habitación</h4>
                </div>
                <form action="admin" method="POST" role="form">
                    <div class="modal-body">
                        <div class="form-floating mb-4">
                            <input type="text" name="roomTypeUp" class="form-control" placeholder="" value='<?= $roomRow['room_type']; ?>'/>
                            <label for="roomTypeUp">Tipo de habitación</label>
                        </div>
                        <div class="form-floating mb-4">
                            <textarea class="form-control" name="roomDescriptionUp" placeholder="" style="height: 100px" ><?= htmlspecialchars($roomRow['description']); ?></textarea>
                            <label for="roomDescriptionUp">Descripción</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="number" name="maxCapacityUp" class="form-control" placeholder="" value='<?= $roomRow['max_capacity']; ?>'/>
                            <label for="maxCapacityUp">Capacidad máxima</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="roomIdUpHidden" value='<?= $roomRow['id']; ?>'>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary" name="submitUpRoom">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php
        endforeach; 
    endif;
?>

<?php 
    if(!empty($bookingTb)) :
        foreach($bookingTb as $bookingRow) : 
?>
    <div class="modal fade" id="deleteBooking<?= $bookingRow['book_id']; ?>" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h4 id="modal-title1" class="modal-title m-auto login text-white">¡Atención!</h4>
                </div>
                <form action="admin" method="POST" role="form">
                    <div class="modal-body">
                        <div class="form-floating mb-4">
                            <p class="text-center fs-5">¿Está seguro que quiere eliminar la reserva <?= $bookingRow['book_id']; ?>?</p>
                            <input type="hidden" name="bookingDel" value='<?= $bookingRow['book_id']; ?>'>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <button type="button" class="btn btn-secondary mb-4" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" name="submitBookingDel" class="btn btn-primary mb-4" data-bs-dismiss="modal">Eliminar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="updateBooking<?= $bookingRow['book_id']; ?>" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="max-width: 25vw;">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 id="modal-title2" class="modal-title m-auto update">Actualizar reserva</h4>
                </div>
                <form action="admin" method="POST" role="form">
                    <div class="modal-body">
                        <div class="form-floating mb-4">
                            <input type="number" name="roomNumUpBooking" class="form-control" placeholder="" value='<?= $bookingRow['room_id']; ?>' />
                            <label for="roomNumUpBooking">Número de habitación</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="date" name="checkInUpBooking" class="form-control" placeholder="" value='<?= $bookingRow['check_in']; ?>'/>
                            <label for="checkInUpBooking">Descripción</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="date" name="checkInOutBooking" class="form-control" placeholder="" value='<?= $bookingRow['check_out']; ?>'/>
                            <label for="checkInOutBooking">Capacidad máxima</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="bookingIdUpHidden" value='<?= $bookingRow['book_id']; ?>'>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary" name="submitUpBooking">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php
        endforeach;
    endif;
?>

<div class="container-admin">
    <div id="sidebar" class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark vh-100">
        <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <img class="logo-admin" src="../public/build/media/logo/favicon-white.png" alt="Logo">
            <span class="fs-4">Dashboard</span>
        </a>
        <hr>
        <ul class="admin-nav nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a href="index" class="nav-link">
                    <span class="material-icons">home</span>
                    Home
                </a>
            </li>
            <li>
                <a href="#booking-tb" class="nav-link text-white active-nav">
                    <span class="material-icons">event_available</span>
                    Reservas
                </a>
            </li>
            <li>
                <a href="#customers-tb" class="nav-link text-white">
                    <span class="material-icons">group</span>
                    Clientes
                </a>
            </li>
            <li>
                <a href="#rooms-tb" class="nav-link text-white">
                    <span class="material-icons">king_bed</span>
                    Habitaciones
                </a>
            </li>
        </ul>
        <hr>
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
                <strong>Admin</strong>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                <li><a class="dropdown-item" href="#">Settings</a></li>
                <li><a class="dropdown-item" href="#">Perfil</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#">Sign out</a></li>
            </ul>
        </div>
    </div>
    <div id="booking-tb" class="content">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-12"><h2>Reservas <b>preparadas</b></h2></div>
                    </div>
                </div>
                <table class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>DNI cliente <i class="fa fa-sort"></i></th>
                            <th>Número de habitación <i class="fa fa-sort"></i></th>
                            <th>Fecha de entrada</th>
                            <th>Fecha de salida <i class="fa fa-sort"></i></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            if(!empty($bookingTb)) :
                                foreach($bookingTb as $bookingRow) : 
                        ?>
                            <tr>
                                <td><?= $bookingRow['book_id'] ?></td>
                                <td><?= $bookingRow['user_nid'] ?></td>
                                <td><?= $bookingRow['room_id'] ?></td>
                                <td><?= $bookingRow['check_in'] ?></td>
                                <td><?= $bookingRow['check_out'] ?></td>
                                <td>
                                    <button type="button" class="btn btn-info text-white" data-bs-toggle="modal" data-bs-target="#updateBooking<?= $bookingRow['book_id']; ?>"><i class="material-icons">&#xE254;</i></button>
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteBooking<?= $bookingRow['book_id']; ?>"><i class="material-icons">&#xE872;</i></button>
                                </td>
                            </tr>
                        <?php 
                                endforeach; 
                            else :
                        ?>
                            <tr>
                                <td class="text-center no-data" colspan="6">No hay datos para mostrar</td>
                            </tr>
                        <?php
                            endif;    
                        ?>
                    </tbody>
                </table>
            </div>
        </div>  
    </div>
    <div id="customers-tb" class="content">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-12"><h2>Detalles de <b>clientes</b></h2></div>
                    </div>
                </div>
                <table class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>DNI</th>
                            <th>Nombre <i class="fa fa-sort"></i></th>
                            <th>Primer Apellido <i class="fa fa-sort"></i></th>
                            <th>Segundo Apellido <i class="fa fa-sort"></i></th>
                            <th>Email</th>
                            <th>Admin <i class="fa fa-sort"></i></th>
                            <th>Teléfono <i class="fa fa-sort"></i></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            if(!empty($customersTb)) :
                                foreach($customersTb as $customersRow) : 
                        ?>
                            <tr>
                                <td><?= $customersRow['nid'] ?></td>
                                <td><?= $customersRow['name'] ?></td>
                                <td><?= $customersRow['surname1'] ?></td>
                                <td><?= $customersRow['surname2'] ?></td>
                                <td><?= $customersRow['email'] ?></td>
                                <?php if($customersRow['admin']) : ?>
                                    <td>Es admin</td>
                                <?php else : ?>
                                    <td>No es admin</td>
                                <?php endif; ?>
                                <td><?= $customersRow['telephone'] ?></td>
                                <td>
                                    <button type="button" class="btn btn-info text-white" data-bs-toggle="modal" data-bs-target="#updateCustomers<?= $customersRow['nid']; ?>"><i class="material-icons">&#xE254;</i></button>
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteCustomers<?= $customersRow['nid']; ?>"><i class="material-icons">&#xE872;</i></button>
                                </td>
                            </tr>
                        <?php 
                                endforeach; 
                            else :
                        ?>
                            <tr>
                                <td colspan="8">No hay datos para mostrar</td>
                            </tr>
                        <?php
                            endif;    
                        ?>
                    </tbody>
                </table>
            </div>
        </div>  
    </div>
    <div id="rooms-tb" class="content">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="w-100 d-flex justify-content-between align-items-center">
                        <h2>Lista de <b>habitaciones</b></h2>
                        <button type="button" class="btn btn-info add-new" data-bs-toggle="modal" data-bs-target="#add-room"><i class="fa fa-plus"></i> Añadir habitación</button>
                    </div>
                </div>
                <table class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Descripción <i class="fa fa-sort"></i></th>
                            <th>Capacidad máxima <i class="fa fa-sort"></i></th>
                            <th>Tipo de habitación <i class="fa fa-sort"></i></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            if(!empty($roomTb)) :
                                foreach($roomTb as $roomRow) : 
                        ?>
                            <tr>
                                <td><?= $roomRow['id'] ?></td>
                                <td><?= $roomRow['description'] ?></td>
                                <td><?= $roomRow['max_capacity'] ?></td>
                                <td><?= $roomRow['room_type'] ?></td>
                                <td>
                                    <button type="button" class="btn btn-info text-white" data-bs-toggle="modal" data-bs-target="#updateRoom<?= $roomRow['id']; ?>"><i class="material-icons">&#xE254;</i></button>
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteRoom<?= $roomRow['id']; ?>"><i class="material-icons">&#xE872;</i></button>
                                </td>
                            </tr>
                        <?php 
                                endforeach; 
                            else :
                        ?>
                            <tr>
                                <td class="text-center no-data" colspan="5">No hay datos para mostrar</td>
                            </tr>
                        <?php
                            endif;    
                        ?>
                    </tbody>
                </table>
            </div>
        </div>  
    </div>
</div>
<?php
    App\Views\Components\createFooter();
?>
