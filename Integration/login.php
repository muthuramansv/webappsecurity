<?php

$html_code  ="<html>

        <title>Web-Application-Security</title>"
    .PageBuilder::printHead().
        "<p>Please fill in your credentials to login.</p>
        <form action=\"<?php echo htmlspecialchars($_SERVER\"PHP_SELF\"); ?>
            <div class=\"form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>\">
                <label>Username</label>
                <input type=\"text\" name=\"username\"class=\"form-control\">
                <span class=\"help-block\"><?php echo $username_err; ?></span>
            </div>    
            <div class=\"form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>\">
                <label>Password</label>
                <input type=\"password\" name=\"password\" class=\"form-control\">
                <span class=\"help-block\"><?php echo $password_err; ?></span>
            </div>
            <div class=\"form-group\">
                <input type=\"submit\" class=\"btn btn-primary\" value=\"Login\">
            </div>
            <p>Don't have an account? <a href=\"register.php\">Sign up now</a>.</p>
        </form>
    </div>    
</body>
</html>";
echo $html_code;
?>