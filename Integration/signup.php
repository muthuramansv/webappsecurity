<?php
include 'classes/session.php';
include 'classes/sign_up_validation.php';


$mysession = new CostumSession('WAS-Secure-Shop', 1800, '/', '127.0.0.1', false, true);

SignUpValidation::management($mysession);

$html_code  =  "<html>"
    .PageBuilder::printHeaderHTML()
    ."<body>"
    ."<div id=\"basket_home\"><a href=\"index.php\">Home</a></div>"
    .PageBuilder::printHead()
    .PageBuilder::printSignUpForm($mysession).
    "</body>"
    .PageBuilder::printFooter().
    "</html>";

echo $html_code;
?>
