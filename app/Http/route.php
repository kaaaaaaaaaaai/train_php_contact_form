<?php

namespace App\Http;

class route {
    public function dispatch(){

        //urlのパラメーターを分ける。
        $url = $_SERVER['REQUEST_URI'];
        //最初の/をとって/で区切る 最初がcontroller名　次がaction名となる。
        list($_ControllerName, $_ActionName) = explode("/", trim($url,'/'));
        //コントローラーのインスタンスを作る。
        require_once "controller/".$_ControllerName."Controller.php";
        //class名を作る。
        $controllerClassName = $_ControllerName."Controller";
        $controllerInstance = new $controllerClassName();
        //そのアクションメソッドの実行
        $controllerInstance->$_ActionName();
    }
}