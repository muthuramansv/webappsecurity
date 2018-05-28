<?php

include("connect_class.php");

$connectToDb = new SimpleConnectDB();


 
// Array as return Value; here 5 Values.
 //$arrayTest = $connectToDb->get_tbl_items();
//$arrayTest = $connectToDb->get_tbl_user_login(); 
//$arrayTest = $connectToDb->get_tbl_basket();
$arrayTest = $connectToDb->get_tbl_orders();

// Example Access
for($x = 0; $x < count($arrayTest); $x++) {
    print_r ($arrayTest[$x]);
    print_r ("<br><br><br><br><br>");
}




?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Websecurity</title>


</head>
<body>




</body>
</html>