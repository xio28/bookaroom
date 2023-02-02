<?php
/**
 * This is a PHP code of a class named BookingController that belongs to the namespace App\Controllers
 * The class provides different methods to handle the data from the forms 
 */

/**
 * Create a namespace
 */
namespace App\Controllers;

use App\Models\Booking;

class BookingController {
    public function handler($post) {
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
