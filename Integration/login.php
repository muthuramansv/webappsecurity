<?php
include 'classes/pageBuilder.php';
include 'classes/connect_class.php';
include 'classes/session.php';
include 'classes/login_handler.php';

$mysession = new CostumSession('WAS-Secure-Shop', 1800, '/', '127.0.0.1', false, true);
$connectToDb = new SimpleConnectDB();
LoginHandler::checkLoginSubmission($mysession);



$html_code  ="<html>

        <title>Web-Application-Security</title>"
    .pageBuilder::printHead().
        "<p>Please fill in your credentials to login.</p>
        <form action=\"<?php echo htmlspecialchars($_SERVER\"PHP_SELF\"); ?>
            <div class=\"form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>\">
                <label>Username</label>
                <input type=\"text\" name=\"username\"class=\"form-control\" placeholder='Enter Username' required>
                <span class=\"help-block\"><?php echo $username_err; ?></span>
            </div>    
            <div class=\"form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>\">
                <label>Password</label>
                <input type=\"password\" name=\"password\" class=\"form-control\" placeholder='Enter Password' required>
                <span class=\"help-block\"><?php echo $password_err; ?></span>
            </div>
            <div class=\"form-group\">
                <input type=\"submit\" class=\"btn btn-primary\" value=\"Login\">
            </div>
            <p>Don't have an account? <a href=\"signup.php\">Sign up now</a>.</p>
        </form>
    </div>    
</body>
</html>";
echo $html_code;
?>