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
        if($db->getUserTokenFromDB($mysession->getUserToken())){
            return true;
        }
        return false;
    }

    static function logOutUser($mysession, $db){
        if ($mysession->getUserToken() != null){
            return $db->removeToken($mysession->getUserToken());
        }
    }

    static function validateWithDB($mysession, $db){
        if(is_array($mysession->getFromSession("article"))){
            foreach($mysession->getFromSession("article") as $item){ 
                $result = $db->getItemByID($item->getID());
                $item->setName($result[0]);
                $item->setPrice($result[1]);
            }
        }
    }

    static function placedOrder($mysession, $db){
        //self::checkLoggedIn($mysession, $db)
        if (self::checkSubmitOrder($mysession)){
            echo PageBuilder::printMessage("Your Order has been placed successfull and You are automatically logged out!");
            $mysession->deleteFromSession("article");
            self::logOutUser($mysession, $db);
        }
    }

    
}
?>