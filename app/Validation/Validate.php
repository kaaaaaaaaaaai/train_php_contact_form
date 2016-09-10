<?php

namespace App\Validation;

class Validate {
    protected $rules    = array();
    protected $data     = array();
    protected $message  = array();
    protected $is_success = true;

    public function setData($data){
        $this->data = $data;
    }

    public function setRules($rules){
        $this->rules = $rules;
    }

    public function run(){
        //ruleで回す
        foreach ($this->rules as $key => $value){
            //定義されているか確認
            if(method_exists(__CLASS__, $value)){
                //method true

                //dataがあるか
                if(isset($this->data[$key])){
                    //rule名のmethodを呼び出す
                    if(!$this->$value($key)){
                        //失敗なら
                        $this->setMessage($key, $value, "Need {$value} type");
                    }
                }else{
                    //Dataがない
                    $this->setMessage($key, $value, "Need Set {$value}");
                }

            }else{
                //method false
                $this->setMessage($key, $value, "{$value} is not define");
            }
        }

        return $this->is_success;
    }

    private function required($key){
        return !is_null($this->data[$key]);
    }

    private function numeric($key){
        return is_numeric($this->data[$key]);
    }

    private function email($key){
        return preg_match("/^([a-zA-Z0-9\._-])*@([a-zA-Z0-9\._-]+)/", $this->data[$key]);
    }

    private function bool($key){
        return is_bool($this->data[$key]);
    }

    public function getMessage(){
        return $this->message;
    }

    private function setMessage($key, $value, $message){
        $this->message[$key][$value] = $message;
        $this->is_success = false;
    }
}

//中身があるのにruleがないとエラーでる。
//多重配列対応してない
//２個同じkeyでくると困る
/*
 * true pattern
 */
/*
$validate = new Validate();
$truePattern = array(
    "name"  =>"ogita",
    "age"   =>22,
    "email" =>"ogita@rich.co.jp",
    "gender"=>true
);
$validate->setData($truePattern);

$rules = array(
    "name"  => "required",
    "age"   => "numeric",
    "email" => "email",
    "gender"=> "bool"
);
$validate->setRules($rules);

if(!$validate->run()){
    var_dump($validate->getMessage());
}else{
    print_r("success".PHP_EOL);
}
*/
/*
 *
 * false pattern
 */
/*
$validate = new Validate();
$truePattern = array(
    "name"  => null,
    "age"   => "わからん",
    "email" => "!!ogita!!@rich!.co.jp",
    "gender"=> 0
);
$validate->setData($truePattern);

$rules = array(
    "name"  => "required",
    "age"   => "numeric",
    "name"  => "reqqq",
    "age"   =>  "number",
    "email" =>  "email",
    "gender"=> "bool",

);
$validate->setRules($rules);

if(!$validate->run()){
    var_dump($validate->getMessage());
}
*/
