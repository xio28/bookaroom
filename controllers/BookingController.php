<?php
/**
 * This is a PHP code of a class named BookingController that belongs to the namespace App\Controllers
 * The class provides different methods to handle the data from the forms, an static function to get all the data from the database or a method to clean the data
 */

/**
 * Create a namespace
 */
namespace App\Controllers;
/**
 * Use the Booking class
 */
use App\Models\Booking;

/**
 * Class BookingController
 *
 * A class for handling and clean the data from the form, or listing the records 
 */
class BookingController {
    
    /**
     * Get and clean the data from the form
     * @param array $data The form data to be cleaned and passing to the model
     * @return void
     */
    public function handler(array $post) : void {
        foreach($post as $key => $val) {
            $values[$key] = $this->sanitize($val);
        }
        
        /**
         * @var object $booking Instance of the Booking class
         */
        $booking = new Booking();

        /**
         * Depending on the contion, will run one or another method
         */
        if(array_key_exists('bookRoomSubmit', $values)) {
            $booking->insert($values);
        }
        elseif(array_key_exists('submitUpBooking', $values)) {
            
            $booking->update($values);
        } 
        elseif(array_key_exists('submitBookingDel', $values)) {
            $booking->delete($values['bookingDel']);
        }
    }
    /**
     * Clean the data removing blank spaces or special characters
     * @param string $data The data retrieved from the form
     * @return string
     */
    private function sanitize(string $data) : string {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        
        return $data;
    }

    /**
     * Retrieve all the data from the booking table
     * @return array
     */
    public static function getBookingList() : array {
        $booking = new Booking();

        return $booking->selectAll();
    }
    
}
?>
