<?php

include("connect_class.php");

$connectToDb = new SimpleConnectDB();
$test = "The Web Application Hacker's Handbook";

$connectToDb->Get_tbl_items($test);


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