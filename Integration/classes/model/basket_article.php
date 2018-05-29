<?php 
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
        $this->id = $myid;
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
}
?>