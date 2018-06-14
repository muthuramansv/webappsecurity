<?php
include 'data_validation.php';


class SignUpValidation
{
    private static $username = null;
    private static $firstname = null;
    private static $lastname = null;
    private static $mail = null;
    private static $password = null;
    private static $cnfpassword = null;
    private static $address = null;

    public static function signupSubmit($mysession)
    {
        if(isset($_POST["token"])) {
            if ($mysession->validateToken($_POST["token"])) {
                if (isset($_POST["firstname"]) && $_POST["firstname"] != "") {
                    if (isset($_POST["lastname"]) && $_POST["lastname"] != "") {
                        if (isset($_POST["mail"]) && $_POST["mail"] != "") {
                            if (isset($_POST["password"]) && $_POST["password"] != "") {
                                if (isset($_POST["cnfpassword"]) && $_POST["cnfpassword"] != "" ){
                                    if (isset($_POST["address"]) && $_POST["address"] != "") {
                                        self::$username = $_POST["username"];
                                        self::$firstname = $_POST["firstname"];
                                        self::$lastname = $_POST["lastname"];
                                        self::$mail = $_POST["mail"];
                                        self::$password = $_POST["password"];
                                        self::$cnfpassword = $_POST["cnfpassword"];
                                        self::$address = $_POST["address"];
                                        //var_dump();
                                        return true;

                                    }
                                }
                            }
                        }
                    }
                }
                DataValidation::all_Empty();
                return false;
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
        DataValidation::html_sanitization(self::$password);
        DataValidation::html_sanitization(self::$cnfpassword);
        DataValidation::html_sanitization(self::$address);
        return true;
    }

    //Name checker method
    public static function nameValidation()
    {
        if (DataValidation::checkNames(self::$firstname) && DataValidation::checkNames(self::$lastname)){
            return true;
        }
        return false;
    }

    //Email Checker method
    public static function emailValidation()
    {
        if (DataValidation::checkEmailAddress(self::$mail)){
            return true;
        }
        return false;
    }

    //Password Checker method
    public static function passValidation()
    {
        if (DataValidation::checkPasswords(self::$password)){
            return true;
        }
        return false;
    }

    //Userid checker method
    public static function useridValidation()
    {
        if (DataValidation::checkUsername(self::$username)){
            return true;
        }
        return false;
    }

    //Password equality checker method
    public static function equalPasswords()
    {
        if (DataValidation::equalPasswords(self::$password, self::$cnfpassword)){
            //var_dump(self::$password_1, self::$password_2);
            return true;
        }
        return false;
    }

    //Address checker method
    public static function checkAddress()
    {
        if (DataValidation::checkAddress(self::$address)){
            return true;
        }
        return false;
    }


    
    //To Add User data into the DB with token verification
    public static function signupData($mysession)
    {
        $signupdata = new SimpleConnectDB();
        if($signupdata->checkUSER(self::$mail) == 1){ //Should be changed to only mail checking!!!
            echo PageBuilder::printError("An User already exists with same Email ID, Try logging in or enter a different Email ID!");
            return false;
        }
        else
        {
            $signupdata->set_tbl_user(self::$firstname, self::$lastname, self::$address, self::$mail, self::$password, $mysession->getUserToken());
            return true;
        }
    }

    //Management function
    public static function management($mysession)
    {
        if (self::signupSubmit($mysession)) {
            if (self::htmlValidation() && self::nameValidation() && self::emailValidation() && self::passValidation() && self::useridValidation() && self::checkAddress() && self::equalPasswords()){
                if (self::signupData($mysession)){
                    return true;
                }
            }
        }
        return false;
    }
}
?>