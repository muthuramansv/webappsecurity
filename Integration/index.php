<?php
//Main Entry Point of the Site the index.php

//Don't display any erros to the user
ini_set("display_errors",	0);

//Include necessary classes
include 'classes/session.php';
include 'classes/pageBuilder.php';
include 'classes/basket_handler.php';

//Instantiate all necessary classes, some of them would be better static for example CostumSession
$mysession = new CostumSession('WAS-Secure-Shop', 1800, '/', '127.0.0.1', false, true);
$connectToDb = new SimpleConnectDB();
BasketHandler::checkBasketSubmission($mysession);

$arrayTest = $connectToDb->get_tbl_items();

//PageBuilder class is used as a single place where all the Tags for diplay are created and the required data is inserted.
//This way it is easy to change titles or styles.
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
