<?php 
class CostumSession {
    private $token = null;  
    public $old_token = null; //just for debugging
    function __construct() {
        session_start();
        $this->generateToken();
    }
    function saveInSession($key, $value) {
        if($key != 'token'){
            $_SESSION[$key] = $value;
        }
    } 
    private function checkForOldToken(){
        if($this->old_token){
            return true;
        }
        return false;
    }
    private function generateToken() {
        if(isset($_SESSION['token'])){
            $this->old_token = $_SESSION['token'];
        } 
        $this->token = md5(openssl_random_pseudo_bytes(32));
        $_SESSION['token'] = $this->token;
    }
    public function getToken(){
        return $this->token;
    }
    function validateToken($form_token){
        if($this->checkForOldToken){
            if($form_token == $this->old_token){ //Case: $form_token = "null"...
                return true;
            }
        }
        return false;
    }
}
?>