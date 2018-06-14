<?php
class OrderHandler {
    static function checkLoggedIn($mysession, $db){ //Timeout!!!
        if($db->getUserToken($mysession->getUserToken())){
            return true;
        }
        return false;
    }

    static function logOutUser($db){
        return $db->removeToken($mysession->getUserToken());
    }
}
?>