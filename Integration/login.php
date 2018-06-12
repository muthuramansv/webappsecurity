<?php
include 'classes/pageBuilder.php';
include 'classes/log_in_validation.php';

LoginValidation::login_management();

//Never used Bootstrap CSS classes? //Also Interactions should be secured using CSRF
$html_code  = "<html>"
        .PageBuilder::printHeaderHTML()
        ."<body>"
        .pageBuilder::printHead()
        .pageBuilder::printLoginForm()
        ."</body>"
        .PageBuilder::printFooter()
        ."</html>";
echo $html_code;
?>
