<?php
//Class for everything which is related to the orders Page (order.php)
class OrderHandler {
    //Check if someone clicked on "Place Order"
    //Everything is as well secure against csrf
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

    //Used to don't expose any data to not logged in users. So first check if the user is logged in!
    static function checkLoggedIn($mysession, $db){ //Timeout!!!
        if($db->getUserTokenFromDB($mysession->getUserToken())){
            return true;
        }
        return false;
    }

    //These Method could have been better designed!
    //Return the Firstname of the costumer based on the UserToken
    static function getFirstnameByToken($mysession, $db){
        if ($db->getUserTokenFromDB($mysession->getUserToken())){
            return $db->getUserTokenFromDB($mysession->getUserToken())[0][2];
        }
    }

    //These Method could have been better designed!
    //Return the Lastname of the costumer based on the UserToken
    static function getLastnameByToken($mysession, $db){
        if ($db->getUserTokenFromDB($mysession->getUserToken())){
            return $db->getUserTokenFromDB($mysession->getUserToken())[0][3];
        }
    }

    //These Method could have been better designed!
    //Return the Address of the costumer based on the UserToken
    static function getAddressByToken($mysession, $db){
        if ($db->getUserTokenFromDB($mysession->getUserToken())){
            return $db->getUserTokenFromDB($mysession->getUserToken())[0][1];
        }
    }

    //These Method could have been better designed especially because is it redundant!
    //Logs out the user by deleting the token from the DB
    static function logOutUser($mysession, $db){
        if ($mysession->getUserToken() != null){
            return $db->removeToken($mysession->getUserToken());
        }
    }

    //Without this method it is easily possible to order items for 0Euro by just editing the hidden fields on the index.php
    //This method syncs the final basket finally with the Database to prevent misuse
    static function validateWithDB($mysession, $db){
        if(is_array($mysession->getFromSession("article"))){
            foreach($mysession->getFromSession("article") as $item){ 
                $result = $db->getItemByID($item->getID());
                $item->setName($result[0]);
                $item->setPrice($result[1]);
            }
        }
    }

    //Management Method for coordinating all the methods in this class
    static function placedOrder($mysession, $db){
        if (self::checkSubmitOrder($mysession) && self::checkLoggedIn($mysession, $db)){
            foreach($mysession->getFromSession("article") as $item){
                $db->set_tbl_orders($mysession->getUserToken(), $item->getID(), $item->getCount());
            }
            echo PageBuilder::printMessage("Your Order has been placed successfull and You are automatically logged out!");
            $mysession->deleteFromSession("article");
            self::logOutUser($mysession, $db);
        }
    }

    
}
?>