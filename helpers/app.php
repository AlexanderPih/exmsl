<?php
namespace exmsl;

require_once(dirname(__DIR__) . '/config/initialize.php');

class App {

     /**
     * Redirects to $newLocation
     * @param $newLocation
     */
    public static function redirect($newLocation) {
        header("Location:" . $newLocation);
        exit;
    }

    public static function message() {
        if(isset($_SESSION['message'])) {
            $output  = "<div class=\"messages\">";
            $output .= htmlentities($_SESSION["message"]);
            $output .= "</div>";

            // clear message after use
            $_SESSION["message"] = null;
            return $output;
        }
    }
}