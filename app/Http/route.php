<?php
namespace App\Http;

class route {
    protected $request;

    public function __construct(Request $req)
    {
        $this->request = $req;
    }

    public function dispatch(){

        //urlのパラメーターを分ける。
        $url = $_SERVER['REQUEST_URI'];
        //最初の/をとって/で区切る 最初がcontroller名　次がaction名となる。

        $params = explode("/", trim($url,'/'));

        if (!isset($params[0])) throw new HttpException(404,"Class NotFound");
        if (!isset($params[1])) throw new HttpException(404,"Method NotFound");

        /*paramからcontroller名とAction名をとる*/
        $_ControllerName    = $params[0];

        //append HttpParameter
        $_ActionName        = mb_strtolower($this->request->getRequestMethod())."_".$params[1];

        if(!class_exists("App\\Controller\\{$_ControllerName}Controller")) throw new HttpException(404,"class Undefined");

        $controllerClassName = "App\\Controller\\{$_ControllerName}Controller";

        //action判定
        if(!method_exists($controllerClassName,"{$_ActionName}")) throw new HttpException(404,"Method Undefined");
        
        $controllerInstance = new $controllerClassName();
        //そのアクションメソッドの実行
        $controllerInstance->$_ActionName();
    }
}