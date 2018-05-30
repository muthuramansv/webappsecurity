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
        session_create_id($this->generator());
        if(!(isset($_SESSION['token']))){
            $this->generateToken();   
        }
        $this->token = $_SESSION['token'];
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
