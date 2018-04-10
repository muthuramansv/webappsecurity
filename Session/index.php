<?php
 include 'session.php';
 $mysession = new CostumSession;
 print($mysession->getToken()); 
 print('<br>');
 print($_SESSION['token']);
 print('<br>');
 print($mysession->old_token);
?>