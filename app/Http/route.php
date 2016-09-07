<?php
namespace App\Http;

class route {
    public function dispatch(){

        //urlのパラメーターを分ける。
        $url = $_SERVER['REQUEST_URI'];
        //最初の/をとって/で区切る 最初がcontroller名　次がaction名となる。

        $params = explode("/", trim($url,'/'));

        if (!isset($params[0])){
            // return 404
            throw new HttpException(404,"Class NotFound");
        }

        $_ControllerName = $params[0];

        if(!isset($params[1])) {
            //404
            throw new HttpException(404,"Method NotFound");
        }

        $_ActionName = $params[1];
        //コントローラーのインスタンスを作る。
        if(!class_exists("App\\Controller\\{$_ControllerName}Controller")){
            //未定義error
            throw new HttpException(404,"class Undefined");
        }
        //fileの有無の判定
        $controllerClassName = "App\\Controller\\{$_ControllerName}Controller";

        if(!method_exists($controllerClassName,"{$_ActionName}")){
            //未定義error
            throw new HttpException(404,"Method Undefined");
        }


        $controllerInstance = new $controllerClassName();
        //そのアクションメソッドの実行
        //get postの判定
        $view = $controllerInstance->$_ActionName();
        
    }
}