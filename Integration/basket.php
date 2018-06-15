<?php

include 'classes/pageBuilder.php';
include 'classes/basket_handler.php';
include 'classes/session.php';

$mysession = new CostumSession('WAS-Secure-Shop', 1800, '/', '127.0.0.1', false, true);
BasketHandler::checkRemoveFromBasket($mysession);



$html_code  =   "<html>"
                .PageBuilder::printHeaderHTML()
                ."<body>"
                .PageBuilder::printNavigation($mysession)
                .PageBuilder::printHead()
                .PageBuilder::printAdvertisment()
                .pageBuilder::printBasketTable(BasketHandler::getBasket($mysession), $mysession, BasketHandler::totalBasketCount($mysession), BasketHandler::totalBasketPrice($mysession))
                .PageBuilder::printFooter()
                ."</body></html>";

echo $html_code;
?>



