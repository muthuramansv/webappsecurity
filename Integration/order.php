<?php

include 'classes/session.php';
include 'classes/pageBuilder.php';
include 'classes/basket_handler.php';
include 'classes/order_handler.php';

$connectToDb = new SimpleConnectDB();
$mysession = new CostumSession('WAS-Secure-Shop', 1800, '/', '127.0.0.1', false, true);
OrderHandler::validateWithDB($mysession, $connectToDb);
OrderHandler::placedOrder($mysession, $connectToDb);

$html_code  =   "<html>"
                .PageBuilder::printHeaderHTML().
                "<body>"
                .PageBuilder::printNavigation($mysession)
                .PageBuilder::printHead()
                .PageBuilder::printDeliveryAddress(OrderHandler::getAddressByToken($mysession, $connectToDb), OrderHandler::getFirstnameByToken($mysession, $connectToDb), OrderHandler::getLastnameByToken($mysession, $connectToDb), OrderHandler::checkLoggedIn($mysession, $connectToDb))
                .PageBuilder::printOrderTable(BasketHandler::getBasket($mysession), $mysession, BasketHandler::totalBasketCount($mysession), BasketHandler::totalBasketPrice($mysession), OrderHandler::checkLoggedIn($mysession, $connectToDb))
                .PageBuilder::printFooter()
                ."</body></html>";

echo $html_code;
?>



