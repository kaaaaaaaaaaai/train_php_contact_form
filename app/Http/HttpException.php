<?php
/**
 * Created by PhpStorm.
 * User: kaiogita
 * Date: 2016/09/08
 * Time: 0:12
 */
namespace App\Http;

class HttpException extends \Exception{

    public function __construct($code, $message)
    {
        /*
         * header("HTTP/1.1 {$code}");
         * echo "{$message}";
         * */
        die("{$code} => {$message}");
    }
}