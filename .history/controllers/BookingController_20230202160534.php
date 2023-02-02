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
     * Get the data from the form
     * @param array $data The booking data to be inserted
     * @return void
     */
    public function handler(array $post)  {
        foreach($post as $key => $val) {
            $values[$key] = $this->sanitize($val);
        }
        
        $booking = new Booking();

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

    public static function getBookingList() {
        $booking = new Booking();

        return $booking->selectAll();
    }
    
    private function sanitize($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        
        return $data;
    }
}
?>
