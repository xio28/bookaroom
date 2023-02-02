<?php
    session_start();
    /**
     * Main routing file
     *
     * @author xio28
     * @version 1.0
     */
    require '../vendor/autoload.php';

    use App\Controllers\BookingController;
    use App\Controllers\UsersController;
    use App\Controllers\RoomsController;
    use App\Controllers\LoginController;

    $slug = $_GET['slug'] ?? '';
    $slug = explode('/', $slug);

    $resource = $slug[0] === '' ? '/' : $slug[0];

    $user = new UsersController();
    $room = new RoomsController();
    $login = new LoginController();
    $booking = new BookingController();

    switch($resource) {
        case '/':
        case 'index':

            require_once('../views/index.php');
            break;
        case 'admin':
            if(isset($_SESSION['login']) && $_SESSION['login']['admin']) {
                require_once('../views/admin.php');
            } 
            elseif(!isset($_SESSION['login']) || ((isset($_SESSION['login']) && !$_SESSION['login']['admin']))) {
                require_once('../views/404.php');
            }

            if($_POST) {
                if(isset($_POST['submitUserDel']) || isset($_POST['submitUpUser'])) {
                    $user->handler($_POST);
                }
                elseif(isset($_POST['submitRoomDel']) || isset($_POST['submitUpRoom']) || isset($_POST['signUpRoom'])) {
                    $room->handler($_POST);
                } 
                elseif(isset($_POST['submitBookingDel']) || isset($_POST['submitUpBooking'])) {
                    $booking->handler($_POST);
                }

                $_POST = [];
                require_once('../views/admin.php');
            }

            break;
        case 'login':

            if($_POST) {
                $login->validateLogin($_POST);
                require_once('../views/index.php');
            }

            require_once('../views/login.php');
            break;
        case 'logout':

            unset($_SESSION['login']);
            require_once('../views/index.php');
            break;
        case 'signup':

            require_once('../views/signup.php');
            if($_POST) {
                $user->handler($_POST);
            }
            break;
        case 'booking':

            require_once('../views/booking.php');

            if(($_POST && !isset($_SESSION['login'])) && isset($_POST['bookRoomSubmit'])) {
                echo '<script>alert("Debe estar logeado para poder reservar");</script>';
                $_POST = [];
                require_once('../views/booking.php');
            }
            elseif($_POST && isset($_SESSION['login']) && isset($_POST['bookRoomSubmit'])) {
                $booking->handler($_POST);
            }
            break;
        default:
            /**
             * Renders the 404 template
             */
            require_once('../views/404.php');
    }
?>
