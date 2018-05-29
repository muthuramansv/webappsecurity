<?php 

include 'model/basket_article.php';

class BasketHandler {
    public static function checkBasketSubmission($mysession) {
        if(isset($_POST["id"]) && isset($_POST["token"]) && isset($_POST["name"]) && isset($_POST["price"])){
            if($mysession->validateToken($_POST["token"])){
                $tmp_article = new BasketArticle($_POST["id"], $_POST["name"], $_POST["price"], 1);
                $mysession->saveArticle($tmp_article);
            }
        }
    }

    public static function getBasket($mysession) {
        return $mysession->getFromSession('article');
    }
}
?>