<?php 
class BasketHandler {
    public static function checkBasketSubmission($mysession) {
        if(isset($_GET["item"]) && isset($_GET["token"])){
            if($mysession->validateToken($_GET["token"])){
                $mysession->saveInSession("item", $_GET["token"]);
            }
        }
    }
}
?>