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

    public static function printHeaderHTML(){
        return "<head>
                <title>".self::$mainHead."</title>
                <link rel=\"stylesheet\" type=\"text/css\" href=\"css/style.css\">
                <meta http-equiv=\"Content-Security-Policy\" content=\"default-src 'self'; child-src 'none';\">
                </head>";
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

    public static function printOrderTable($basket, $mysession, $totalCount, $totalPrice){
        $i = 1;
        
        if (count($basket) > 0){
            $output = "<table border=\"1\">
                    <tbody>
                        <tr>
                            <th>Number</th>
                            <th>Article</th> 
                            <th>Price</th>
                            <th>Count</th>
                        </tr>";
            foreach($basket as $item){
                $output = $output."<tr>
                    <td>".$i++."</td>
                    <td>".$item->getName()."</td> 
                    <td>".number_format($item->getPrice(), 2)."€</td>
                    <td>".$item->getCount()."</td>
                </tr>";
            }               
            $output = $output."   
                <tr>
                    <td colspan=\"2\">Total</td>
                    <td>".number_format($totalPrice, 2)."€</td>
                    <td>".$totalCount."</td>
                </tr>
                <tr>
                    <td  colspan=\"2\">&nbsp;</td>

                    </td>
                    <td colspan=\"2\">
                        <form action=\"index.php\">
                            <input class=\"link\" type=\"submit\" value=\"Cancel Order\">
                        </form>
                    </td>
                </tr>
                <tr>
                    <td  colspan=\"2\">&nbsp;</td>

                    </td>
                    <td colspan=\"2\">
                        <form action=\"login.php\" method=\"post\">
                            <input type=\"hidden\" name=\"token\" value=\"".$mysession->getToken()."\">
                            <input class=\"link\" type=\"submit\" value=\"Place Order\">
                        </form>
                    </td>
                </tr>
            </tbody>
            </table>";
        }else {
            $output = "<h4>Your Basket is empty! Nothing to Check Out!</h4><a href=\"index.php\">Return to Home</a>";
        }
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

    public static function printLoginForm($mysession){
        return "
        <h2>Please fill in your credentials to login.</h2>
        <form method=\"POST\" action=\"login.php\" ?>
            <p>
                <label>Username Or Email</label>
                <input type=\"text\" name=\"username\" placeholder='Enter Username or Email'>
                
            </p>    
            <p>
                <label>Password</label>
                <input type=\"password\" name=\"password\" class=\"form-control\" placeholder='Enter Password'>
                
            </p>
            <p>
                <input class=\"simple_button\" type=\"submit\" value=\"Login\">
                <input type=\"hidden\" name=\"token\" value=\"".$mysession->getToken()."\">
            </p>
            <p>Don't have an account? <a href=\"signup.php\">Sign up now</a>.</p>
        </form>";
    }

    public static function printSignUpForm($mysession){
        return "<h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form method=\"POST\" action=\"signup.php\">
		    <p>
                <label>First Name</label>
                <input type=\"text\" name=\"firstname\" placeholder='Enter First Name' >
            </p>
			<p>
                <label>Last Name</label>
                <input type=\"text\" name=\"lastname\" placeholder='Enter last Name' >
            </p>
            <p>
                <label>Username</label>
                <input type=\"text\" name=\"username\" placeholder='Enter Username' >
            </p>
             <p>
                <label>E-Mail ID</label>
                <input type=\"text\" name=\"mail\" placeholder='Enter Valid Email Id' >
             </p>
            <p>
                <label>Password</label>
                <input type=\"password\" name=\"password_1\" placeholder='Enter Password' >
            </p>
            <p>
                <label>Confirm Password</label>
                <input type=\"password\" name=\"password_2\" placeholder='Re-Enter Password' >
            </p>
            <p>
                <label>Address</label>
                <textarea type=\"text\" name=\"address\" rows=\"4\" cols=\"50\" ></textarea>
            </p>
            <p>
                <input class=\"simple_button\" type=\"submit\" value=\"Sign Up\">
                <input type=\"hidden\" name=\"token\" value=\"".$mysession->getToken()."\">
            </p>
            <p>Already have an account? <a href=\"login.php\">Login here</a></p>
        </form>";
    }
	
    public static function printError($error){
        return "<div>".$error."<div>";
    }

    public static function printFooter(){
        return "<footer>
                    <hr>
                    <p>".self::$mainHead." ".self::$subHead."</p>
                    <p>Contact information: <a href=\"mailto:admin@was-shop.com\">admin@was-shop.com</a></p>
                </footer>";
    }
} 
?>
