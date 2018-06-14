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
        if (preg_match('/^[\w\W][\w\W]{1,20}$/', $input)) {
            return true; //Illegal Character found!
        } else {
            echo PageBuilder::printError("Please enter alphabets only in name fields.");
            return false;
        }
    }

    //Almost the same as checkNames but allow whitspaces because of Street-Names and House-Numbers
    static function checkAddress($input)
    {
        if (preg_match('/^[\W\w\d,][\W\w\d\s,]{1,40}$/', $input)) {
            return false; //Illegal Character found!
        }
        else{
            echo PageBuilder::printError("Please enter alphabets and numbers with comma seperation, maximum of 40 characters.");
            return false;
        }
    }

    // accepted password length between 8 and 20, start with character and can have special character.
    static function checkPasswords($input)
    {
        if (preg_match('/^[\W\w\d!@#$%][\W\w\d!@#$%]{8,20}$/', $input)) {
            return true;//Illegal Character found
        } else{
            echo PageBuilder::printError("Password should be between 8 to 20 characters long with alphabets, at the least one number and at the least one special characters from ! @ # $ %.");
            return false;
        }
    }

    //Confirming passwords entered.
    static function equalPasswords($input1, $input2){

        if ($input2 != $input1) {
            echo("Error... Passwords do not match");
          echo PageBuilder::printError("Passwords are matching.");
            return false;//Equal.

        } else {
           echo PageBuilder::printError("Passwords are matching.");
            return true;
        }
    }


    //Validation of username.
    static function checkUsername($input)
    {
        if (preg_match('/^[\W\w\d][\W\w\d]{7,20}$/', $input)) {
            return true;//Illegal Character found
        } else{
            echo PageBuilder::printError("Username should be between 7 to 20 characters long with alphabets, numbers.");
            return false;
        }
    }
}
?>
