<?php

include 'classes/pageBuilder.php';
include 'classes/connect_class.php';
include 'classes/session.php';


$mysession = new CostumSession('WAS-Secure-Shop', 1800, '/', '127.0.0.1', false, true);
$connectToDb = new SimpleConnectDB();
$arrayTest = $connectToDb->get_tbl_items();

$html_code = "      <html>
                    <title>Web-Application-Security</title>"
                    .PageBuilder::printHead().
                     PageBuilder::printTable($arrayTest)."
                    </body>
                    </html>";

echo $html_code;
?>