<?php

namespace App\Http;

class Request{

    protected $query;
    protected $request;
    protected $httpMethod;

    public function __construct()
    {
        foreach ($_GET as $key => $value) {
            $this->query[$key]  =   $value;
        }
        foreach ($_POST as $key => $value) {
            $this->request[$key]  = $value;
        }
        $this->httpMethod = $_SERVER["REQUEST_METHOD"];
    }

    public function getQuery($key){
        return $this->query[$key];
    }

    public function getPost($key){
        return $this->request[$key];
    }

    public function hasQuery($key){
        return isset($this->query[$key])?true:false;
    }
    public function hasPost($key){
        return isset($this->request[$key])?true:false;
    }

    public function getPostAll(){
        return $this->request;
    }

    public function getRequestMethod(){
        return $this->httpMethod;
    }
}