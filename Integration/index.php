<?php
ini_set("display_errors",	0);
include 'classes/session.php';
include 'classes/pageBuilder.php';
include 'classes/basket_handler.php';

$mysession = new CostumSession('WAS-Secure-Shop', 1800, '/', '127.0.0.1', false, true);
$connectToDb = new SimpleConnectDB();
BasketHandler::checkBasketSubmission($mysession);

$arrayTest = $connectToDb->get_tbl_items();

$html_code =        "<html>"
                    .PageBuilder::printHeaderHTML().
                    "<body>"
                    .PageBuilder::printNavigation($mysession)
                    .PageBuilder::printHead()
                    .PageBuilder::printAdvertisment()
                    .PageBuilder::printItemTable($arrayTest, $mysession)
                    .PageBuilder::printFooter().
                    "</body></html>";

echo $html_code;
?>
