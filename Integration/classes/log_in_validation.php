<?php
include 'login_data_validation.php';


class LoginValidation
{
    private static $mail = null;
    private static $password = null;

    public static function loginSubmit($mysession)
    {
        if (isset($_POST["mail"]) && isset($_POST["password"]) && isset($_POST["token"])) {
            if($mysession->validateToken($_POST["token"])){
                self::$mail = $_POST["mail"];
                self::$password = $_POST["password"];
                return true;
            }
            return false;
        }
    }

    //Function for html_sanitization one of the methods to prevent XSS. Should be used for all user-input just to make sure
    //there is no malicious content in it like tags.
    public static function loginHtmlValidation()
    {
        LoginDataValidation::login_html_sanitization(self::$mail);
        LoginDataValidation::login_html_sanitization(self::$password);
        return true;
    }

    //Email Checker Method
    public static function loginEmailValidation()
    {
        if (LoginDataValidation::checkEmailAddress(self::$mail)){
            return true;
        }
        return false;
    }

    //Password Checker Method
    public static function loginPassValidation()
    {
        if (LoginDataValidation::checkPasswords(self::$password)){
            return true;
        }
        return false;
    }

    //Send Validated Data onto DB for Login
    public static function loginData()
    {
        $logindata = new SimpleConnectDB();
        if($logindata->checkLoginCredentials(self::$mail, self::$password)){
            return true;
        }
        echo PageBuilder::printError("Username or Password is Incorrect!");
        return false;
    }
    
    //Login Management Method
    public static function login_management($mysession)
    {
        if (self::loginSubmit($mysession))
        {
           if(self::loginHtmlValidation() && self::loginEmailValidation())
            {
                if (self::loginData()){
                    return true;
                }
            }
        }
        return false;
    }
}

?>
