<?php

include("connect_class.php");

$connectToDb = new SimpleConnectDB();
$test = "The Web Application Hacker's Handbook";

 
// Array as return Value; here 5 Values.
$arrayTest = $connectToDb->Get_tbl_items($test); 

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