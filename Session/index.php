<?php
 include 'session.php';
 $mysession = new CostumSession('WAS-Secure-Shop', 1800, '/', '127.0.0.1', false, true);
 print($mysession->getToken()); 
 print('<br>');
 print($_SESSION['token']);
 print('<br>');
 print(session_id());
 print($mysession->validateToken('123'));
 ?>