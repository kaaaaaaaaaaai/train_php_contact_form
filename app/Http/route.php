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

        if (!isset($params[0])){
            throw new HttpException(404,"Class NotFound");
        }
        if (!isset($params[1])) {
            throw new HttpException(404,"Method NotFound");
        }

        /*paramからcontroller名とAction名をとる*/

        $_controllerName = $this->ConvertControllerName($params[0]);
        //append HttpParameterw
        $_controllerNameSpace = "App\\Controller\\{$_controllerName}Controller";

        if(!class_exists($_controllerNameSpace)){
            throw new HttpException(404,"class Undefined");
        }

        $_controllerInstance = new $_controllerNameSpace();

        $_lowerRequestMethod = mb_strtolower($this->request->getRequestMethod());

        $_actionName    = "{$_lowerRequestMethod}_{$params[1]}";
        //action判定
        if(!method_exists($_controllerInstance, $_actionName)){
            throw new HttpException(404,"Method Undefined");
        }

        //そのアクションメソッドの実行
        $_controllerInstance->$_actionName();
    }

    private function ConvertControllerName($name){
        //全て小文字にする
        $_lowerControllerName = mb_strtolower($name);
        //先頭文字を大文字に
        $_ControllerName = ucfirst($_lowerControllerName);
        return $_ControllerName;
    }
}