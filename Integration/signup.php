<?php
include 'classes/pageBuilder.php';
include 'classes/connect_class.php';
$html_code  =  "<html>"
    .PageBuilder::printHeaderHTML()
    ."<body>"
    .PageBuilder::printHead()
    .PageBuilder::printSignUpForm().
    "</body></html>";
echo $html_code;
?>
