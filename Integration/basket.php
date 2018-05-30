<?php

include 'classes/pageBuilder.php';
include 'classes/basket_handler.php';
include 'classes/session.php';

$mysession = new CostumSession('WAS-Secure-Shop', 1800, '/', '127.0.0.1', false, true);




$html_code  = "<html>
              <title>Web-Application-Security</title>
              <div style=\"float: right;\"><a href=\"index.php\">Home</a></div>"
              .pageBuilder::printHead()
              .pageBuilder::printBasketTable(BasketHandler::getBasket($mysession), $mysession).
              "</body>
              </html>";

echo $html_code;
?>



