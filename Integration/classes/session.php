<?php
include 'classes/connect_class.php';

//Class for handling everyting which is related to Session. This class just provide a wrapper around the Session to make it easy to manage
class CostumSession {
    private $token = null;
    private $connectToDb = null;

    function __construct($name, $lifetime, $path, $domain, $secure, $httponly) {
        $this->connectToDb = new SimpleConnectDB();
        session_start([ 
            'name' => $name,
            'cookie_lifetime' => $lifetime,
            'cookie_httponly' => $httponly,
            'use_strict_mode' => true,
            'cookie_domain' => '127.0.0.1',
        ]);
        session_regenerate_id();
        //session_create_id($this->generatorRandomPrefixSID()); //Unfortunatly not working under windows-machines!
        //PHP's default session facilities are considered safe, the generated PHPSessionID is random enough...
        //https://www.owasp.org/index.php/PHP_Security_Cheat_Sheet
        if(!(isset($_SESSION['token']))){
            $this->generateToken();
        }
        $this->token = $_SESSION['token'];
        $this->createUserToken();
    }

    //Unfortunatly not used. Should be used to generate random prefixes to make the session_id even more random
    private function generatorRandomPrefixSID(){
        return rand(1, 122);
    }

    //Generator Method. Whenever a unique identfier is required this method is used
    private function generator(){
        return md5(openssl_random_pseudo_bytes(32));
    }

    //Checks an Key in the session
    private function checkSessionKey($key){
        if($key != 'token' || $key != 'article'){
            return true;
        }
        return false;
    }

    //Return the UserToken which is automatically set whenever a user reaches the site
    public function getUserToken(){
        return $this->getFromSession('user_id');
    }

    //Method to create a User Token
    private function createUserToken() {
		if($this->getUserToken()) {
		    return false;
		}
		else {
            do{
                $mytoken = $this->generator();
            } while($this->connectToDb->getUserTokenFromDB($mytoken));
		    $this->saveInSession('user_id', $mytoken);
		    return true;
		}
    }

    //Universal method to save whatever you want in the session
    public function saveInSession($key, $value) {
        if($this->checkSessionKey($key)){
            $_SESSION[$key] = $value;
        }
    }

    //Specific session just for Storing articles in the Session
    public function saveArticle($article){
        if(!(isset($_SESSION['article']))){
            $_SESSION['article'] = array();
        }
        array_push($_SESSION['article'], $article);
    }

    //Universal session to get whatever you want out of the session. Checks before if the key actually exsits
    public function getFromSession($key) {
        if(isset($_SESSION[$key])){
            return $_SESSION[$key];
        }
        return null;
    }

    //Method to generate a crsf token
    private function generateToken() {
        $this->token = $this->generator();
        $_SESSION['token'] = $this->token;
    }

    //Method to access the token to insert it into html code/html form
    public function getToken(){
        return $this->token;
    }

    //Secure deleting keys from session
    public function deleteFromSession($key){
        unset($_SESSION[$key]);
    }

    //Checks the crsf token and generates a new one if it is valid
    public function validateToken($form_token){
        if($form_token === $this->getToken()){
            $this->generateToken();
            return true;
        }
        return false;
    }
}
?>
