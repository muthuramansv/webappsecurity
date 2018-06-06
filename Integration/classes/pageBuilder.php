<?php 
class PageBuilder {
    private static $mainHead = 'Web-Application-Security';
    private static $subHead = 'Web-Shop';
   
    public static function printHead() {
        return "<a href=\"index.php\"><h1>".self::$mainHead."</h1><h2>".self::$subHead."</h2></a>";
    }

    public static function printAdvertisment(){
        return "
        <hr>
        <marquee>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
        </marquee>
        <hr>";
    }

    public static function printItemTable($items, $mysession) {
        $output = " <table border=\"1\">
                    <tbody>
                        <tr>
                            <th>Number</th>
                            <th>Article</th>
                            <th>Price</th>
                            <th>Basket</th>
                        </tr>";
                    
        foreach($items as $item){
            $output = $output."<tr>
            <td>".$item[0]."</td>
            <td>".$item[1]."</td>
            <td>".number_format($item[2], 2)."€</td>
            <td>
                <form action=\"index.php\" method=\"post\">
                    <input type=\"hidden\" name=\"id\" value=\"".$item[0]."\">
                    <input type=\"hidden\" name=\"name\" value=\"".$item[1]."\">
                    <input type=\"hidden\" name=\"price\" value=\"".$item[2]."\">
                    <input type=\"hidden\" name=\"token\" value=\"".$mysession->getToken()."\">
                    <input class=\"link\" type=\"submit\" value=\"Add to Basket\">
                </form>
            </td>
            </tr>";
        }

        $output = $output."</tbody></table>";
        return $output;
    }


    public static function printBasketTable($basket, $mysession, $totalCount, $totalPrice){
        $i = 1;
        
        if (count($basket) > 0){
            $output = "<table border=\"1\">
                    <tbody>
                        <tr>
                            <th>Number</th>
                            <th>Article</th> 
                            <th>Price</th>
                            <th>Count</th>
                            <th>Remove</th>
                        </tr>";
            foreach($basket as $item){
                $output = $output."<tr>
                    <td>".$i++."</td>
                    <td>".$item->getName()."</td> 
                    <td>".number_format($item->getPrice(), 2)."€</td>
                    <td>".$item->getCount()."</td>
                    <td>
                        <form action=\"basket.php\" method=\"post\">
                            <input type=\"hidden\" name=\"id\" value=\"".$item->getID()."\">
                            <input type=\"hidden\" name=\"token\" value=\"".$mysession->getToken()."\">
                            <input class=\"link\" type=\"submit\" value=\"Remove\">
                        </form>
                    </td>
                </tr>";
            }               
            $output = $output."   
                <tr>
                    <td colspan=\"2\">Total</td>
                    <td>".number_format($totalPrice, 2)."€</td>
                    <td>".$totalCount."</td>
                    <td>
                        <form action=\"login.php\" method=\"post\">
                            <input type=\"hidden\" name=\"token\" value=\"".$mysession->getToken()."\">
                            <input class=\"link\" type=\"submit\" value=\"Check-Out\">
                        </form>
                    </td>
                </tr>
            </tbody>
            </table>";
        }else {
            $output = "<h4>Your Basket is empty!</h4><a href=\"index.php\">Return to Home</a>";
        }
        return $output;
    }

    public static function printFooter(){
        return "<footer>
                    <p>".$mainHead." ".$subHead."</p>
                    <p>Contact information: <a href=\"mailto:admin@was-shop.com\">admin@was-shop.com</a></p>
                </footer>";
    }
} 
?>
