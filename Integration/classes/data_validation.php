<?php
include 'pageBuilder.php';


class DataValidation
{

    //If all the tabs are empty
    static function all_Empty()
    {
        echo PageBuilder::printError("Please enter valid data in all the fields, nothing can not be empty.");
    }

    //Function for html_sanitization one of the methods to prevent XSS. Should be used for all user-input just to make sure
    //there is no malicious content in it like tags. 
    static function html_sanitization($input)
    {
        return strip_tags($input);
    }

    //Validates E-Mail according to RFC 822
    static function checkEmailAddress($input)
    {
        if (filter_var($input, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
           echo PageBuilder::printError("Please enter a valid email id.");
            return false;
        }
    }

    //Check if there is anything in the $input Variable which isn't an Word-Character
    static function checkNames($input)
    {
        if (preg_match('~"//^[\w]+$/i"~', $input)) {
            echo PageBuilder::printError("Please enter alphabets only.");
            return false; //Illegal Character found!
        } else {
            return true;
        }
    }

    //Almost the same as checkNames but allow whitspaces because of Street-Names and House-Numbers
    static function checkAddress($input)
    {
        if (preg_match('~"//^[\w\s]+$/i"~', $input)) {
            echo PageBuilder::printError("Please enter alphabets and numbers with comma seperation.");
            return false; //Illegal Character found!
        }
        else{
            return true;
        }
    }

    // accepted password length between 8 and 20, start with character and can have special character.
    static function checkPasswords($input)
    {
        if (preg_match("/^[a-zA-Z][0-9a-zA-Z_!$@#^&]{8,20}$/", $input)) {
            echo PageBuilder::printError("Password should be between 8 to 20 characters long with alphabets, numbers and special characters.");
            return true;//Illegal Character found
        } else{
            return false;
        }
    }

    //Confirming passwords entered.
    static function equalPasswords($input1,$input2){
        if ($input1 == $input2) {
            return true;//Equal.
        } else{
            echo PageBuilder::printError("Passwords are not matching.");
            return false;
        }
    }


    //Validation of username.
    static function checkUsername($input)
    {
        if (preg_match("/^[a-zA-Z0-9]{7,20}$/", $input)) {
            echo PageBuilder::printError("Username should be between 7 to 20 characters long with alphabets, numbers.");
            return true;//Illegal Character found
        } else{
            return false;
        }
    }
}
?>