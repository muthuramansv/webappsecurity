<?php

include 'classes/pageBuilder.php';
include 'classes/connect_class.php';
include 'classes/session.php';
include 'classes/basket_handler.php';

$mysession = new CostumSession('WAS-Secure-Shop', 1800, '/', '127.0.0.1', false, true);
$connectToDb = new SimpleConnectDB();
BasketHandler::checkBasketSubmission($mysession);

$arrayTest = $connectToDb->get_tbl_items();

$html_code = "      <html>
                    <head>
                        <title>Web-Application-Security</title>
                        <div style=\"float: right;\"><a href=\"login.php\">Basket</a></div>
                    </head>
                    <body>"
                    .PageBuilder::printHead().
                     PageBuilder::printItemTable($arrayTest, $mysession)."
                    </body>
                    </html>";

echo $html_code;
?>
