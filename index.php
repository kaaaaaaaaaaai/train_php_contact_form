<?php

require_once __DIR__."/vendor/autoload.php";
require_once __DIR__."/Util.php";

$r = new App\Http\route(new \App\Http\Request());
try{
    $r->dispatch();
}catch (App\Http\HttpException $e){
    echo "error in index.php {$e->getMessage()}";
}
