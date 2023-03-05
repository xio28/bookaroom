<?php
    /**
     * Main routing file
     *
     * @author xio28
     * @version 1.0
     */

    /**
     * Start a new session
     */
    session_start();

    /**
     * Load the composer autoload file
     */
    require '../vendor/autoload.php';

    /**
     * Use the controllers
     */
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
            require_once('../Views/index.php');
            break;
        case 'admin':
            if(isset($_SESSION['login']) && $_SESSION['login']['admin']) {
                require_once('../Views/admin.php');
            } 
            elseif(!isset($_SESSION['login']) || ((isset($_SESSION['login']) && !$_SESSION['login']['admin']))) {
                require_once('../Views/404.php');
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
                require_once('../Views/admin.php');
            }
            break;
        case 'login':
            if($_POST) {
                $login->validateLogin($_POST);
                require_once('../Views/index.php');
            }
            require_once('../Views/login.php');
            break;
        case 'logout':
            unset($_SESSION['login']);
            require_once('../Views/index.php');
            break;
        case 'signup':
            require_once('../Views/signup.php');
            if($_POST) {
                $user->handler($_POST);
            }
            break;
        case 'booking':
            require_once('../Views/booking.php');
            if(!isset($_SESSION['login']) && isset($_POST['bookRoomSubmit'])) {
                echo '<script>alert("Debe estar logeado para poder reservar");</script>';
            }
            elseif(isset($_SESSION['login']) && isset($_POST['bookRoomSubmit'])) {
                $booking->handler($_POST);
            }
            break;
        default:
            require_once('../Views/404.php');
    }
?>
