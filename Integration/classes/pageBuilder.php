<?php 
class PageBuilder {
    private static $mainHead = 'Web-Application-Security';
    private static $subHead = 'Web-Shop';
   
    public static function printHead() {
        return "<h1>".self::$mainHead."</h1><h2>".self::$subHead."</h2>";
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


    public static function printBasketTable($basket, $mysession){
        $i = 1;
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
                <td>".$item->getPrice()." €</td>
                <td>".$item->getCount()."</td>
                <td><a href = \"home.asp\">Remove</a></td>
                <td><form action=\"login.php\" method=\"post\">
                <input type=\"hidden\" name=\"token\" value=\"".$mysession->getToken()."\">
                <input class=\"link\" type=\"submit\" value=\"Check-Out\">
                </form>
                </td>
            </tr>";
        }               
        $output = $output."</tbody></table>";
        return $output;
    }
} 
?>
