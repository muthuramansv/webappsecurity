<?php 
//Class for everything which is related to the logout process
class LogOutHandler {
    //Check if there is a logout request through GET better would be POST here due to time issues GET is used
    //Is as well uses an token to secure against csrf
    static function checkLogOutRequest($mysession){
        if(isset($_GET["logout"]) && isset($_GET["token"])){
            if ($mysession->validateToken($_GET["token"])){
                return true;
            }
        }
        return false;
    }

    //Used to actually logs out the user by deleting his/her token from the DB
    static function logOutUser($mysession, $db){
        if ($mysession->getUserToken() != null){
            return $db->removeToken($mysession->getUserToken());
        }
    }

    //Management function which coordinates all others
    static function logOutChecker($mysession, $db){
        if (self::checkLogOutRequest($mysession)){
            self::logOutUser($mysession, $db);
        }
    }
}
?>