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
                        <link rel=\"stylesheet\" type=\"text/css\" href=\"css/style.css\">
                    </head>
                    <body>
                    <div style=\"float: right;\"><a href=\"basket.php\">Basket</a></div>"
                    .PageBuilder::printHead()
                    .PageBuilder::printAdvertisment()
                    .PageBuilder::printItemTable($arrayTest, $mysession)."
                    </body>
                    ".PageBuilder::printFooter()."
                    </html>";

echo $html_code;
?>
