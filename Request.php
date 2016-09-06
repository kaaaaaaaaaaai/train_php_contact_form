<?php

class Request{
    protected $value;

    public function __construct()
    {
        $this->value;
    }

    public function all(){
        return $this->value;
    }

    public function getValueByKey($key){
        return $this->isSetKey($key)?$this->value[$key]:null;
    }

    private function isSetKey($key){
        return isset($this->value[$key])?true:false;
    }

}

class Post extends Request{

    public function __construct()
    {
        foreach ($_POST as $key => $value) {
            $this->value[$key]  =   $value;
        }
    }


}