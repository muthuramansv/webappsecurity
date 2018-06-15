<?php
//Model used for storing and handling the items during the session
//These objects are stored in the session-storage on the server in an array format
class BasketArticle {
    private $id = null;
    private $name = null;
    private $price = null;
    private $count = null;

    function __construct($myid, $myname, $myprice, $mycount) {
        $this->id = $myid;
        $this->name = $myname;
        $this->price = $myprice;
        $this->count = $mycount;
    }

    public function getID(){
        return $this->id;
    }

    public function getName(){
        return $this->name;
    }

    public function getPrice(){
        return $this->price; 
    }

    public function getCount(){
        return $this->count;
    }

    public function addCount(){
        $this->count++;
    }

    public function subCount(){
        $this->count--;
    }

    public function setName($myname){
        $this->name = $myname;
    }

    public function setPrice($myprice){
        $this->price = $myprice;
    }
}
?>