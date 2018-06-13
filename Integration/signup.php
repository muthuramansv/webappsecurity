<?php
include 'classes/sign_up_validation.php';
include 'classes/session.php';

$mysession = new CostumSession('WAS-Secure-Shop', 1800, '/', '127.0.0.1', false, true);

SignUpValidation::management($mysession);

$html_code  =  "<html>"
    .PageBuilder::printHeaderHTML()
    ."<body>"
    .PageBuilder::printHead()
    .PageBuilder::printSignUpForm($mysession).
    "</body>"
    .PageBuilder::printFooter().
    "</html>";

echo $html_code;
?>
