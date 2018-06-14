<?php
class OrderHandler {
    static function checkSubmitOrder($mysession){
        if(isset($_POST["place"]) && isset($_POST["token"])){
            if($mysession->validateToken($_POST["token"])){
                if($_POST["place"]){
                    return true;
                }
            }
        }
        return false;
    }

    static function checkLoggedIn($mysession, $db){ //Timeout!!!
        if($db->getUserToken($mysession->getUserToken())){
            return true;
        }
        return false;
    }

    static function logOutUser($db){
        return $db->removeToken($mysession->getUserToken());
    }

    static function placedOrder($mysession, $db){
        if (self::checkSubmitOrder($mysession) && self::checkLoggedIn($mysession, $db)){
            PageBuilder::printMessage("Your Order has been successfully placed!");
            $mysession->deleteFromSession("article");
            self::logOutUser();
        }
    }

    
}
?>