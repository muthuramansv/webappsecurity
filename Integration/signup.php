<?php
include 'classes/sign_up_validation.php';

SignUpValidation::management();

$html_code  =  "<html>"
    .PageBuilder::printHeaderHTML()
    ."<body>"
    .PageBuilder::printHead()
    .PageBuilder::printSignUpForm().
    "</body></html>";

echo $html_code;
?>
