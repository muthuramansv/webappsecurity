<?php
include 'login_data_validation.php';
include 'connect_class.php';


class LoginValidation
{
    private static $mail = null;
    private static $password = null;

    public static function loginSubmit()
    {
        if (isset($_POST["mail"])) {
            if (isset($_POST["password"])) {
                self::$mail = $_POST["mail"];
                self::$password = $_POST["password"];
                return true;
            } else {
                LoginDataValidation::all_Empty();
                return false;
            }
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
        LoginDataValidation::checkEmailAddress(self::$mail);
        return true;
    }

    //Password Checker Method
    public static function loginPassValidation()
    {
        LoginDataValidation::checkPasswords(self::$password);
        return true;
    }

    //Send Validated Data onto DB for Login
    public static function loginData()
    {
        $logindata = new SimpleConnectDB();
        $logindata->get_tbl_user_login(self::$mail, self::$password);
    }

    //Login Management Method
    public static function login_management()
    {
        if (self::loginSubmit()) {
            if (self::loginHtmlValidation()) {
                if (self::loginPassValidation()) {
                    self::loginData();
                }
            }
            return true;
        }
        else {
            return false;
        }
    }
}

?>