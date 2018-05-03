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

    public function saveInSession($key, $value) {
        if($key != 'token'){
            $_SESSION[$key] = $value;
        }
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
