<?php 
//Include the basket article because most of the actions in this class are using these objects
include 'model/basket_article.php';

//BasketHandler is the place where all Basket related functions are saves/stored
class BasketHandler {
    //Check if anyone want to submit anything to the basket
    public static function checkBasketSubmission($mysession) {
        if(isset($_POST["id"]) && isset($_POST["token"]) && isset($_POST["name"]) && isset($_POST["price"])){
            if($mysession->validateToken($_POST["token"])){
                self::addToBasket(new BasketArticle($_POST["id"], $_POST["name"], $_POST["price"], 1), $mysession);
            }
        }
    }

    //Use functionality from the Session-Class, is used to return the whole basket
    public static function getBasket($mysession) {
        if ($mysession->getFromSession('article') == null){
            return array();
        }
        return $mysession->getFromSession('article');
    }


    //Adds an new item to the basket
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

    //Removes items each by each from the basket
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

    //Calculates the total-basket-count
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

    //Calculates the total-basket-price
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