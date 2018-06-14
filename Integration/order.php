<?php

include 'classes/pageBuilder.php';
include 'classes/basket_handler.php';
include 'classes/order_handler.php';
include 'classes/session.php';
$connectToDb = new SimpleConnectDB();
$mysession = new CostumSession('WAS-Secure-Shop', 1800, '/', '127.0.0.1', false, true);

$html_code  = "<html>
                  <head>
                      <title>Web-Application-Security</title>
                      <link rel=\"stylesheet\" type=\"text/css\" href=\"css/style.css\">
                  </head>
                  <body>
                  <div style=\"float: right;\"><a href=\"index.php\">Home</a></div>"
                  .pageBuilder::printHead()
                  .pageBuilder::printMessage("Your Order has been placed successfull!")
                  .pageBuilder::printOrderTable(BasketHandler::getBasket($mysession), $mysession, BasketHandler::totalBasketCount($mysession), BasketHandler::totalBasketPrice($mysession), OrderHandler::checkLoggedIn($mysession, $connectToDb)).
                  "</body>
              </html>";

echo $html_code;
?>



