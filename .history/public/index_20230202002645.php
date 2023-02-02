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
     * Shows the template based on the provided resource (url)
     *
     * @param string $resource The resource to be rendered
     */
    switch($resource) {
        /**
         * Homepage
         */
        case '/':
        case 'index':
            /**
             * Shows the index template
             */
            require_once('../views/index.php');
            break;
        
        /**
         * Admin panel
         */
        case 'admin':
            /**
             * If the user is logged in and is an admin, display the admin panel
             * If the user is not logged in or is not an admin, display a 404 page
             */
            if(isset($_SESSION['login']) && $_SESSION['login']['admin']) {
                require_once('../views/admin.php');
            } 
            elseif(!isset($_SESSION['login']) || ((isset($_SESSION['login']) && !$_SESSION['login']['admin']))) {
                require_once('../views/404.php');
            }

            /**
             * If a form is submitted, handle the post request 
             */
            if($_POST) {
                /**
                 * If the user delete or update form is submitted, handle it with the user controller
                 */
                if(isset($_POST['submitUserDel']) || isset($_POST['submitUpUser'])) {
                    $user->handler($_POST);
                }
                /**
                 * If the room delete, update, or sign up form is submitted, handle it with the room controller
                 */
                elseif(isset($_POST['submitRoomDel']) || isset($_POST['submitUpRoom']) || isset($_POST['signUpRoom'])) {
                    $room->handler($_POST);
                }
                /**
                 * If the booking delete or update form is submitted, handle it with the booking controller
                 */
                elseif(isset($_POST['submitBookingDel']) || isset($_POST['submitUpBooking'])) {
                    $booking->handler($_POST);
                }
                /**
                 * Shows the admin panel
                 */
                require_once('../views/admin.php');
            }

            break;
        case 'login':
            /**
             * If the login form is submitted, login controller will handle the post request and redirect to index
             */
            if($_POST) {
                $login->validateLogin($_POST);
                require_once('../views/index.php');
            }
            /**
             * Else shows the login
             */
            require_once('../views/login.php');
            break;
        case 'logout':
            /**
             * Destroy the session 'login' in order to 'logout' the user
             * Then shows the index template to redirect the user to the index
             */
            unset($_SESSION['login']);
            require_once('../views/index.php');
            break;
        case 'signup':
            /**
             * Shows the signup template
             */
            require_once('../views/signup.php');
            /**
             * If signup form is submitted, user controller will handle the post
             */
            if($_POST) {
                $user->handler($_POST);
            }
            break;
        case 'booking':
            /**
             * Shows the booking template
             */
            require_once('../views/booking.php');
            /**
             * Check if user is logged in before processing the submitted form
             * If user is not logged and booking form is submitted, an alert will be displayed 
             */
            if(!isset($_SESSION['login']) && isset($_POST['bookRoomSubmit'])) {
                echo '<script>alert("Debe estar logeado para poder reservar");</script>';
            }
            /**
             * If user is logged and the booking form is submitted 
             */
            elseif(isset($_SESSION['login']) && isset($_POST['bookRoomSubmit'])) {
                $booking->handler($_POST);
            }
            break;
        default:
            /**
             * Shows the 404 template
             */
            require_once('../views/404.php');
    }
?>
