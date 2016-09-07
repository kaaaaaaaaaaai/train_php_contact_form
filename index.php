<?php

require_once __DIR__."/vendor/autoload.php";
require_once __DIR__."/Util.php";

$r = new App\Http\route();
$r->dispatch();