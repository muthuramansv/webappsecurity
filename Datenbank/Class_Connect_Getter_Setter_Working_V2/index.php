<?php

include("connect_class.php");

$connectToDb = new SimpleConnectDB();



// Array as return Value; here 5 Values.
 //$arrayTest = $connectToDb->get_tbl_items();

$string = "test";
$integer_1 = 3567;
$integer_2 = 5;
$integer_3 = 8;
$integer_4 = 8976.434535;
$integer_5 = 8976.453453;
$checkmail = "Toom@test.com";

//$connectToDb->set_tbl_basket($string,$integer_2,$integer_3);
//$connectToDb->set_tbl_orders($integer_1,$integer_2,$integer_3,$integer_4,$integer_5,$string);
//$connectToDb->set_tbl_user($string,$string,$string,$string,$string);
//$arrayTest = $connectToDb->get_tbl_user_login();
$arrayTest = $connectToDb->checkUSER($checkmail);
//$arrayTest = $connectToDb->get_tbl_basket();
//$arrayTest2 = $connectToDb->get_tbl_orders();


// Example Access
for($x = 0; $x < count($arrayTest); $x++) {
    print_r ($arrayTest[$x]);
    print_r ("<br><br><br><br><br>");

}


/*
for($x = 0; $x < count($arrayTest2); $x++) {
    print_r ($arrayTest2[$x]);
    print_r ("<br><br><br><br><br>");
}
*/


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