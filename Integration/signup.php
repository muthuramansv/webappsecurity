<?php
include 'classes/pageBuilder.php';
$html_code  = "<html>
<title>Web-Application-Security</title>"
    .PageBuilder::printHead().
"<body background=\"res/Login_IMG.JPG\">
<div class=\"wrapper\">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action=\"<?php echo htmlspecialchars($_SERVER\"PHP_SELF\"); ?>
		    <div class=\"form-group <?php echo (!empty($F_Name_err);) ? 'has-error' : ''; ?>\" >
                <label>First Name</label>
                <input type=\"text\" name=\"F.Name\"class=\"form-control\" >
                <span class=\"help-block\"></span>
             </div>
			 <div class=\"form-group <?php echo (!empty($L_Name_err);) ? 'has-error' : ''; ?>\">
                <label>Last Name</label>
                <input type=\"text\" name=\"L.Name\"class=\"form-control\" >
                <span class=\"help-block\"></span>
             </div>
            <div class=\"form-group <?php echo (!empty($username_err);) ? 'has-error' : ''; ?>\">
                <label>Username</label>
                <input type=\"text\" name=\"username\"class=\"form-control\" >
                <span class=\"help-block\"><?php echo $username_err; ?></span>
            </div> 
             <div class=\"form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>\">
                <label>E-Mail ID</label>
                <input type=\"text\" name=\"E-Mail\"class=\"form-control\" >
                <span class=\"help-block\"><?php echo $email_err; ?></span>
             </div>			
			
            <div class=\"form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>\">
                <label>Password</label>
                <input type=\"password\" name=\"password\" class=\"form-control\" >
                <span class=\"help-block\"><?php echo $password_err; ?></span>
            </div>
            <div class=\"form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>\">
                <label>Confirm Password</label>
                <input type=\"password\" name=\"confirm_password\" class=\"form-control\" >
                <span class=\"help-block\"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class=\"form-group\">
                <input type=\"submit\" class=\"btn btn-primary\" value=\"Submit\">
                <input type=\"reset\" class=\"btn btn-default\" value=\"Reset\">
            </div>
            <p>Already have an account? <a href=\"login.php\">Login here</a>.</p>
        </form>
    </div>    
</body>
</html>";

echo $html_code;

?>
