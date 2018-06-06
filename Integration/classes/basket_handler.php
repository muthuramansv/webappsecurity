<?php 

include 'model/basket_article.php';

class BasketHandler {
    public static function checkBasketSubmission($mysession) {
        if(isset($_POST["id"]) && isset($_POST["token"]) && isset($_POST["name"]) && isset($_POST["price"])){
            if($mysession->validateToken($_POST["token"])){
                self::addToBasket(new BasketArticle($_POST["id"], $_POST["name"], $_POST["price"], 1), $mysession);
            }
        }
    }

    public static function getBasket($mysession) {
        if ($mysession->getFromSession('article') == null){
            return array();
        }
        return $mysession->getFromSession('article');
    }


    private static function addToBasket($newElement, $mysession){
        if ($mysession->getFromSession('article') != null){
            foreach($mysession->getFromSession('article') as $element){
                if($element->getID() == $newElement->getID()){
                    $element->addCount();
                    return true;
                }
            }
        }
        $mysession->saveArticle($newElement);
        return true;
    }

    public static function checkRemoveFromBasket($mysession){
        if (is_array($mysession->getFromSession('article')) && isset($_POST["id"]) && isset($_POST["token"])){
            if($mysession->validateToken($_POST["token"])){
                $deleteid = $_POST["id"];
                foreach($mysession->getFromSession('article') as $key => $element){
                    if($element->getID() == $deleteid){
                        if($element->getCount() > 0){
                            $element->subCount();
                        }
                        if($element->getCount() <= 0){
                            unset($_SESSION['article'][$key]);
                            array_values($mysession->getFromSession('article'));
                        } 
                        return true;

                    }
                }
            }
        }
        return false;
    }

    public static function totalBasketCount($mysession){
        $count = 0;
        if (is_array($mysession->getFromSession('article'))){
            foreach($mysession->getFromSession('article') as $item){
                $count += $item->getCount();
            }
            return $count;
        }
        return 0; 
    }

    public static function totalBasketPrice($mysession){
        $price = 0;
        if (is_array($mysession->getFromSession('article'))){
            foreach($mysession->getFromSession('article') as $item){
                $price += ($item->getCount() * $item->getPrice());
            }
            return $price;
        }
        return 0;
    }
}
?>