<?php

namespace App\Http;

class Request{

    public function getQuery($key){
        return $this->hasQuery($key)?$_GET[$key]:null;
    }

    public function getPost($key){
        return $this->hasPost($key)?$_POST[$key]:null;
    }

    public function hasQuery($key){
        return isset($_GET[$key])?true:false;
    }
    public function hasPost($key){
        return isset($_POST[$key])?true:false;
    }

    public function getPostAll(){
        return $_POST;
    }

    public function getRequestMethod(){
        return $_SERVER["REQUEST_METHOD"];
    }

    public function getReferer(){
        return $_SERVER['HTTP_REFERER'];
    }
}