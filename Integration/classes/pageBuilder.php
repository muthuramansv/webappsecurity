<?php
//Class for the frontend rendering. This class is used to create all the html tags needed for display. Insert the appropiate data and get the html_string back
class PageBuilder {
    private static $mainHead = 'Web-Application-Security';
    private static $subHead = 'Web-Shop';
   
    //Print Main Headline of each Page
    public static function printHead() {
        return "<a href=\"index.php\"><h1>".self::$mainHead."</h1><h2>".self::$subHead."</h2></a>";
    }

    //Print the Marquee rolling text...Very cool but deprecated tag :(
    public static function printAdvertisment(){
        return "
        <hr>
        <marquee>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
        </marquee>
        <hr>";
    }

    //Print the Header section from html
    public static function printHeaderHTML(){
        return "<head>
                <title>".self::$mainHead."</title>
                <link rel=\"stylesheet\" type=\"text/css\" href=\"css/style.css\">
                <meta http-equiv=\"Content-Security-Policy\" content=\"default-src 'none'; script-src 'self'; connect-src 'self'; img-src 'self'; style-src 'self';\" >
                </head>";
    }

    //Print the item table for the index.php
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

    //Method to Print the orders table for the order.php
    public static function printOrderTable($basket, $mysession, $totalCount, $totalPrice, $loggedin){
        $i = 1;
        
        if ((count($basket) > 0) && $loggedin){
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
                        <form action=\"order.php\" method=\"post\">
                            <input type=\"hidden\" name=\"token\" value=\"".$mysession->getToken()."\">
                            <input type=\"hidden\" name=\"place\" value=\"1\">
                            <input class=\"link\" type=\"submit\" value=\"Place Order\">
                        </form>
                    </td>
                </tr>
            </tbody>
            </table>";
        }else {
            $output = "<h4>Your Basket is empty! Or You are not logged in!</h4><a href=\"index.php\">Return to Home</a>";
        }
        return $output;
    }

    //Print Method for print the Basket for the basket.php
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
                        <form action=\"order.php\" method=\"post\">
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

    //Print Method for the LoginForm taket the Session object to get the needed token id to prevent from csrf
    public static function printLoginForm($mysession){
        return "
        <h2>Please fill in your credentials to login.</h2>
        <form method=\"POST\" action=\"login.php\" ?>
            <p>
                <label>Email</label>
                <input type=\"text\" name=\"mail\" placeholder='Enter Email'>
                
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

    //Print Method for the SignupForm taket the Session object to get the needed token id to prevent from csrf
    public static function printSignUpForm($mysession){
        return "<h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form method=\"POST\" action=\"signup.php\">
		    <p>
                <label>First Name</label>
                <input type=\"text\" name=\"firstname\" size='50px' placeholder='Enter Firstname'>
            </p>
			<p>
                <label>Last Name</label>
                <input type=\"text\" name=\"lastname\" size='50px' placeholder='Enter Lastname' >
            </p>
            <p>
                <label>Username</label>
                <input type=\"text\" name=\"username\" size='50px' placeholder='Enter Username' >
            </p>
             <p>
                <label>E-Mail ID</label>
                <input type=\"text\" name=\"mail\" size='50px' placeholder='Enter Valid Email Id' >
             </p>
            <p>
                <label>Password</label>
                <input type=\"password\" name=\"password\" size='50px' placeholder='Enter Password' >
            </p>
            <p>
                <label>Confirm Password</label>
                <input type=\"password\" name=\"cnfpassword\" size='50px' placeholder='Re-Enter Password' >
            </p>
            <p>
                <label>Address</label>
                <input type=\"text\" name=\"address\" size='50px'  placeholder='Enter Address'>
            </p>
            <p>
                <input class=\"simple_button\" type=\"submit\" value=\"Sign Up\">
                <input type=\"hidden\" name=\"token\" value=\"".$mysession->getToken()."\">
            </p>
            <p>Already have an account? <a href=\"login.php\">Login here</a></p>
        </form>";
    }
    
    //Basic erros print method
    public static function printError($error){
        return "<p>".$error."</p>";
    }

    //Print method for the footer
    public static function printFooter(){
        return "<footer>
                    <hr>
                    <p>".self::$mainHead." ".self::$subHead."<p>Contact information: <a href=\"mailto:admin@was-shop.com\">admin@was-shop.com</a></p>
                </footer>";
    }

    //Print message for user output
    public static function printMessage($msg){
        return "<div id=\"msg_box\">".$msg."</div>";
    }

    //Display the delivery address on the order.php
    public static function printDeliveryAddress($address, $firstname, $lastname, $loggedin){
        if ($loggedin){
        return "<div id=\"delivery_details\">
            <p>Your Delivery Address is:</p>
            <p>".$firstname." ".$lastname."</p>
            <p>".$address."</p>
        </div>";
        }
        return "";
    }

    public static function printNavigation($mysession){
        return "<div id=\"navigation\"><a href=\"index.php\">Home</a>&nbsp;|&nbsp;<a href=\"basket.php\">Basket</a>&nbsp;|&nbsp;<a href=\"order.php\">Current Order</a>&nbsp;|&nbsp;<a href=\"login.php\">Login</a>/<a href=\"login.php?logout=1&token=".$mysession->getToken()."\">Logout</a></div>";
    }
} 
?>
