<?php 
class PageBuilder {
    private static $mainHead = 'Web-Application-Security';
    private static $subHead = 'Web-Shop';
   
    public static function printHead() {
        return "<h1>".self::$mainHead."</h1><h2>".self::$subHead."</h2>";
    }

    public static function printTable($items) {
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
            <td><a href=\"home.asp\">Add to Basket</a></td>
            </tr>";
        }

        $output."</tbody></table>";
        return $output;
    }
} 
?>