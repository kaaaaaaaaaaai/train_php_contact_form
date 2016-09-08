<?php

require_once __DIR__."/vendor/autoload.php";
require_once __DIR__."/Util.php";

$r = new App\Http\route(new \App\Http\Request());
try{
    $r->dispatch();
}catch (HttpException $e){
    
}
