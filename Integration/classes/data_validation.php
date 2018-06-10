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

}