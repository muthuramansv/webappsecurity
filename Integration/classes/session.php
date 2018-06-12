<?php
class CostumSession {
    private $token = null;
    function __construct($name, $lifetime, $path, $domain, $secure, $httponly) {
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

    private function generatorRandomPrefixSID(){
        return rand(1, 122);
    }

    private function generator(){
        return md5(openssl_random_pseudo_bytes(32));
    }

    private function checkSessionKey($key){
        if($key != 'token' || $key != 'article'){
            return true;
        }
        return false;
    }

    public function getUserToken(){
        return $this->getFromSession('user_id');
    }

    private function createUserToken() {
		if($this->getFromSession('user_id') != null) {
		    return 0;
		}
		else {
		    $this->saveInSession('user_id', $this->generator());
		    return 1;
		}
    }

    public function saveInSession($key, $value) {
        if($this->checkSessionKey($key)){
            $_SESSION[$key] = $value;
        }
    }

    public function saveArticle($article){
        if(!(isset($_SESSION['article']))){
            $_SESSION['article'] = array();
        }
        array_push($_SESSION['article'], $article);
    }

    public function getFromSession($key) {
        if(isset($_SESSION[$key])){
            return $_SESSION[$key];
        }
        return null;
    }

    private function generateToken() {
        $this->token = $this->generator();
        $_SESSION['token'] = $this->token;
    }

    public function getToken(){
        return $this->token;
    }

    public function validateToken($form_token){
        if($form_token === $this->getToken()){
            $this->generateToken();
            return true;
        }
        return false;
    }
}
?>
