<?php

include 'classes/pageBuilder.php';
include 'classes/connect_class.php';

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