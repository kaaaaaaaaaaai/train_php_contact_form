<?php

namespace App\Controller;

class contactController{

    public function index(){
        //require_once("/Users/hw-0138/train_workspace/php_contactForm/view/input.php");
        //view();

        //templateを読み込むため
        view("view.input");
    }

    public function confirm(){
        $req = new Post();
        var_dump($req->getValueByKey('name'));
        
    }
}