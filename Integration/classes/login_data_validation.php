<?php

class LoginDataValidation
{

    //If all the tabs are empty
    static function all_Empty()
    {
        echo PageBuilder::printError("Please enter Email and Password, nothing can not be empty.");
        return false;
    }

    //Function for html_sanitization one of the methods to prevent XSS. Should be used for all user-input just to make sure
    //there is no malicious content in it like tags.
    static function login_html_sanitization($input)
    {
        return strip_tags($input);
    }

    //Validates E-Mail according to RFC 822
    static function checkEmailAddress($input)
    {
        if (filter_var($input, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            echo PageBuilder::printError("Username or Password is Incorrect!");
            return false;
        }
    }

    //Validated password length between 8 and 20, start with character and can have special character.
    static function checkPasswords($input)
    {
        if (preg_match("/^[a-zA-Z][0-9a-zA-Z_!$@#^&]{8,20}$/", $input)) {
            echo PageBuilder::printError("Password should be between 8 to 20 characters long with alphabets, numbers and special characters.");
            return true;//Illegal Character found
        } else{
            return false;
        }
    }
}
?>
