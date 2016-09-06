<?php

require "/Users/hw-0138/train_workspace/php_contactForm/Request.php";

class contactController{

    public function index(){
        require_once("/Users/hw-0138/train_workspace/php_contactForm/view/input.php");
    }

    public function confirm(){
        $req = new Post();
        
        var_dump($req->getValueByKey('name'));
        
    }
}