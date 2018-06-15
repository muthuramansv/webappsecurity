<?php
ini_set("display_errors", 0); //Better error_log("error1", 3, "/var/tmp/app_error.log");	
include 'classes/session.php';
include 'classes/pageBuilder.php';
include 'classes/log_in_validation.php';
include 'classes/logout_handler.php';

$mysession = new CostumSession('WAS-Secure-Shop', 1800, '/', '127.0.0.1', false, true);
$connectToDb = new SimpleConnectDB();
LoginValidation::login_management($mysession);
LogOutHandler::logOutChecker($mysession, $connectToDb);

//Never used Bootstrap CSS classes? //Also Interactions should be secured using CSRF
$html_code  =   "<html>"
                .PageBuilder::printHeaderHTML().
                "<body>"
                .PageBuilder::printNavigation($mysession)
                .PageBuilder::printHead()
                .pageBuilder::printLoginForm($mysession)
                ."</body>"
                .PageBuilder::printFooter()
                ."</html>";
echo $html_code;
?>