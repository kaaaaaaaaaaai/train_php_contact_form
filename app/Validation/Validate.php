<?php

namespace App\Validation;

class Validate {
    protected $ruleData    = "";
    protected $data     = array();
    protected $message  = array();
    protected $is_success = true;
    protected $num      = 0;

    public function setData($data){
        $this->data = $data;
    }

    public function setRules($ruleData){
        $this->ruleData = $ruleData;
    }

    public function run(){
        /* $ruleData = ["name" => "required|max:255"]
         * ruleの|の切り出し
         */

        foreach ($this->ruleData as $adaptDataKey => $ruleText){
            // |で複数区切られている場合は切り分ける
            if(preg_match("/|/", $ruleText)){
                $ruleArray = explode("|", $ruleText);

                foreach ($ruleArray as $rule){
                    //切り分け後実行
                    $this->method_run($rule, $adaptDataKey);
                }
            }else{
                //切り分けないならそのまま実行
                $this->method_run($ruleText, $adaptDataKey);
            }
        }

        return $this->is_success;
    }

    /*
     * $rule  = 呼び出すruleMethod名
     * $key   = validationするdataのkey
     * */
    private function method_run($rule, $key){
        //ruleに範囲があるならそれを切り出す
        if(preg_match("/:/", $rule)){
            $params     = explode(":", $rule);
            $rule       = $params[0];
            $this->num  = $params[1];
        }

        if(method_exists(__CLASS__, $rule)){
            //dataがあるか
            if(isset($this->data[$key])){
                //rule名のmethodを呼び出す
                if(!$this->$rule($key, $this->num)){
                    //失敗なら
                    $this->setMessage($key, $rule, "Need {$rule} type");
                }
            }else{
                //Dataがない
                $this->setMessage($key, $rule, "Need Set {$rule}");
            }
        }else{
            //method false
            $this->setMessage($key, $rule, "{$rule} is not define");
        }
    }

    private function required($key){
        if(is_null($this->data[$key])){
            return false;
        }
        //空白を取り除いて空白判定
        if((preg_replace("/( |　)/", "", $this->data[$key]) == "")){
            return false;
        }
        return true;

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

    private function max($key, $num=1){
        if(strlen($this->data[$key]) <= $num){
            return true;
        }else{
            return false;
        }
    }

    private function min($key, $num=1){
        if(strlen($this->data[$key]) >= $num){
            return true;
        }else{
            return false;
        }
    }

    public function getMessage(){
        return $this->message;
    }

    private function setMessage($key, $value, $message){
        $this->message[$key][$value] = $message;
        $this->is_success = false;
    }
}