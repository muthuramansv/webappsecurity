<?php

include 'classes/session.php';
include 'classes/pageBuilder.php';
include 'classes/basket_handler.php';
include 'classes/order_handler.php';

$connectToDb = new SimpleConnectDB();
$mysession = new CostumSession('WAS-Secure-Shop', 1800, '/', '127.0.0.1', false, true);

OrderHandler::placedOrder($mysession, $connectToDb);

$html_code  =     "<html>"
                  .PageBuilder::printHeaderHTML()
                  ."<body>
                  <div id=\"basket_home\"><a href=\"index.php\">Home</a></div>"
                  .pageBuilder::printHead()
                  .pageBuilder::printDeliveryAddress("TestWeg15", "Joshua", "Becker", 1)
                  .pageBuilder::printOrderTable(BasketHandler::getBasket($mysession), $mysession, BasketHandler::totalBasketCount($mysession), BasketHandler::totalBasketPrice($mysession), 1).
                  "</body>
              </html>";

echo $html_code;
//OrderHandler::checkLoggedIn($mysession, $connectToDb)
?>



