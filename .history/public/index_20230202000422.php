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
    /**
     * Retrieve the `slug` value from the URL and explode it into an array
     * If the `slug` is not present in the URL, it will be set to an empty string
     */
    $slug = $_GET['slug'] ?? '';
    $slug = explode('/', $slug);

    /**
     * Get the first element of the `slug` array as the resource
     * If the first element is an empty string, it will be set to "/"
     */
    $resource = $slug[0] === '' ? '/' : $slug[0];

    /**
     * Create new instances of the `UsersController`, `RoomsController`, `LoginController`, `BookingController` classes
     */
    $user = new UsersController();
    $room = new RoomsController();
    $login = new LoginController();
    $booking = new BookingController();

    /**
     * Renders the template based on the provided resource (url)
     *
     * @param string $resource The resource to be rendered
     */
    switch($resource) {
        case '/':
        case 'index':
            /**
             * Renders the index template
             */
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
            /**
             * Renders the login template and validates the login
             */
            if($_POST) {
                $login->validateLogin($_POST);
                require_once('../views/index.php');
            }

            require_once('../views/login.php');
            break;
        case 'logout':
            /**
             * Delete the session 'login' in order to 'logout' the user
             * Then renders the index template to redirect the user to the index
             */
            unset($_SESSION['login']);
            require_once('../views/index.php');
            break;
        case 'signup':
            /**
             * Renders the signup template and handles, using the `UsersController` method `handler`, the user registration
             */
            require_once('../views/signup.php');
            if($_POST) {
                $user->handler($_POST);
            }
            break;
        case 'booking':
            /**
             * Renders the booking template and handles the user reservations
             */
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
