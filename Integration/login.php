<?php
include 'classes/session.php';
include 'classes/pageBuilder.php';
include 'classes/log_in_validation.php';


$mysession = new CostumSession('WAS-Secure-Shop', 1800, '/', '127.0.0.1', false, true);

LoginValidation::login_management($mysession);

//Never used Bootstrap CSS classes? //Also Interactions should be secured using CSRF
$html_code  = "<html>"
        .PageBuilder::printHeaderHTML()
        ."<body>"
                ."<div id=\"basket_home\"><a href=\"index.php\">Home</a></div>"
        .pageBuilder::printHead()
        .pageBuilder::printLoginForm($mysession)
        ."</body>"
        .PageBuilder::printFooter()
        ."</html>";
echo $html_code;
?>
