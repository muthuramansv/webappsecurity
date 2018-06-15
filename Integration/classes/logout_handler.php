<?php 
class LogOutHandler {
    static function checkLogOutRequest($mysession){
        if(isset($_GET["logout"]) && isset($_GET["token"])){
            if ($mysession->validateToken($_GET["token"])){
                return true;
            }
        }
        return false;
    }

    static function logOutUser($mysession, $db){
        if ($mysession->getUserToken() != null){
            return $db->removeToken($mysession->getUserToken());
        }
    }

    static function logOutChecker($mysession, $db){
        if (self::checkLogOutRequest($mysession)){
            self::logOutUser($mysession, $db);
        }
    }
}
?>