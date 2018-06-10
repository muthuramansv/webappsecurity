<?php
/**
 * Created by PhpStorm.
 * User: muthu
 * Date: 5/30/2018
 * Time: 1:06 PM
 */

class data_validation
{
    //Function for html_sanitization one of the methods to prevent XSS. Should be used for all user-input just to make sure
    //there is no malicious content in it like tags. 
    function html_sanitization($input){
        return strip_tags($input);
    }

    //Validates E-Mail according to RFC 822
    function checkEmailAdress($input){
        if (filter_var($input, FILTER_VALIDATE_EMAIL)) {
            return true;
        }else {
            return false;
        }
    }

    //Check if there is anything in the $input Variable which isn't an Word-Character
    function checkNames($input){
        if (preg_match("//^[\w]+$/i", $input)) {
            return false; //Illegal Character found!
        }
        return true;
    }

    //Almost the same as checkNames but allow whitspaces because of Street-Names and House-Numbers
    function checkAddress($input){
        if (preg_match("//^[\w\s]+$/i", $input)) {
            return false; //Illegal Character found!
        }
        return true;
    }

}
?>