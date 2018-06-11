<?php
include 'classes/pageBuilder.php';

//Never used Bootstrap CSS classes? //Also Interactions should be secured using CSRF
$html_code  ="<html>

        <title>Web-Application-Security</title>"
    .pageBuilder::printHead().
        "<div class=\"wrapper\">
        <h2>Please fill in your credentials to login.</h2>
        <form method='POST' action=\"login_handler.php\" ?>
            <div class=\"input-group\">
                <label>Username Or Email</label>
                <input type=\"text\" name=\"username\" class=\"form-control\" placeholder='Enter Username or Email'>
                
            </div>    
            <div class=\"input-group\">
                <label>Password</label>
                <input type=\"password\" name=\"password\" class=\"form-control\" placeholder='Enter Password'>
                
            </div>
            <div class=\"input-group\">
                <button input type=\"submit\" class=\"btn btn-primary\" value=\"submit\"> Login</button>
            </div>
            <p>Don't have an account? <a href=\"signup.php\">Sign up now</a>.</p>
        </form>
    </div>    
</body>
</html>";
echo $html_code;
?>