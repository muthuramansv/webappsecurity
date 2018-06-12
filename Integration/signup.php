<?php
include 'classes/sign_up_validation.php';

SignUpValidation::management();

$html_code  = "<html>
<title>Web-Application-Security</title>"
    .PageBuilder::printHead().
    "<div class=\"wrapper\">

        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        
        <form  method='POST' action=\"signup.php\">
		    <div class=\"input-group\">
                <label>First Name</label>
                <input type=\"text\" name=\"firstname\"class=\"form-control\" placeholder='Enter First Name' >
             </div>
             
			 <div class=\"input-group\">
                <label>Last Name</label>
                <input type=\"text\" name=\"lastname\"class=\"form-control\" placeholder='Enter last Name' >
             </div>
            <div class=\"input-group\">
                <label>Username</label>
                <input type=\"text\" name=\"username\" placeholder='Enter Username' >
            </div>
             <div class=\"input-group\">
                <label>E-Mail ID</label>
                <input type=\"text\" name=\"mail\"class=\"form-control\" placeholder='Enter Valid Email Id' >
             </div>
            <div class=\"input-group\">
                <label>Password</label>
                <input type=\"password\" name=\"password_1\" class=\"form-control\" placeholder='Enter Password' >
            </div>
            <div class=\"input-group\">
                <label>Confirm Password</label>
                <input type=\"password\" name=\"password_2\" class=\"form-control\" placeholder='Re-Enter Password' >
            </div>
            <div class=\"input-group\">
            <label>Address</label>
            <textarea type=\"text\" name=\"address\" rows=\"4\" cols=\"50\"  class=\"input - group\" >
            </textarea>
            <div class=\"input-group\">
            <button input type=\"submit\" class=\"btn btn-primary\" value=\"submit\"> Submit</button>
            </div>
            <p>Already have an account? <a href=\"login.php\">Login here</a>.</p>
        </form>
    </div>
</body>
</html>";
echo $html_code;
?>
