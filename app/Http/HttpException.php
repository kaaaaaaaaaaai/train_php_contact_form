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
        $this->code     = $code;
        $this->message  = $message;
        header("HTTP/1.0 {$code} {$message}");
        parent::__construct($this->__toString(), $code, null);
    }

    // オブジェクトの文字列表現を独自に定義する
    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }

}