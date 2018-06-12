<?php
include 'data_validation.php';


class SignUpValidation
{
    private static $username = null;
    private static $firstname = null;
    private static $lastname = null;
    private static $mail = null;
    private static $password_1 = null;
    private static $password_2 = null;
    private static $address = null;

    public static function signupSubmit()
    {
        if (isset($_POST["firstname"])) {
            if (isset($_POST["lastname"])) {
                if (isset($_POST["mail"])) {
                    if (isset($_POST["password_1"])) {
                        if (isset($_POST["password_2"])) {
                            if (isset($_POST["address"])) {
                                self::$username = $_POST["firstname"];
                                self::$firstname = $_POST["firstname"];
                                self::$lastname = $_POST["lastname"];
                                self::$mail = $_POST["mail"];
                                self::$password_1 = $_POST["password_1"];
                                self::$password_2 = $_POST["password_2"];
                                self::$address = $_POST["address"];
                                return true;
                            } else {
                                DataValidation::all_Empty();
                                return false;
                            }
                        }
                    }
                }
            }
        }
    }


    //Html_sanitization method
    public static function htmlValidation()
    {

        DataValidation::html_sanitization(self::$username);
        DataValidation::html_sanitization(self::$firstname);
        DataValidation::html_sanitization(self::$lastname);
        DataValidation::html_sanitization(self::$mail);
        DataValidation::html_sanitization(self::$password_1);
        DataValidation::html_sanitization(self::$password_2);
        DataValidation::html_sanitization(self::$address);
        return true;
    }

    //Name checker method
    public static function nameValidation()
    {
        DataValidation::checkNames(self::$firstname);
        DataValidation::checkNames(self::$lastname);
        return true;
    }

    //Email Checker method
    public static function emailValidation()
    {
        DataValidation::checkEmailAddress(self::$mail);
        return true;
    }

    //Password Checker method
    public static function passValidation()
    {
        DataValidation::checkPasswords(self::$password_1);
        return true;
    }

    //Userid checker method
    public static function useridValidation()
    {
        DataValidation::checkUsername(self::$username);
        return true;
    }

    //Address checker method
    public static function checkAddress()
    {
        DataValidation::checkAddress(self::$firstname);
        return true;
    }

    //Password equality checker method
    public static function equalPassword()
    {
        DataValidation::equalPasswords(self::$password_1, self::$password_2);
        return true;

    }

    //Management function
    public static function management()
    {
        if (self::signupSubmit()) {
            self::htmlValidation();
            self::nameValidation();
            self::emailValidation();
            self::passValidation();
            self::useridValidation();
            self::checkAddress();
            self::equalPassword();
            return true;
        } else {
            return false;
        }
    }
}
?>










