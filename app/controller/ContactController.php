<?php

namespace App\Controller;

use App\Http\Request;
use App\Validation\Validate;

class contactController{
    public function get_input(){
        //templateを読み込むため
        view("view/input");
    }

    public function post_confirm(Request $request){
        $validate = new Validate();
        $validate->setData($request->getPostAll());
        $rules = [
            'name'      =>  'required|max:255',
            'gender'    =>  'required',
            'comment'   =>  'max:255|required',
            'email'     =>  'required|email',
        ];
        //set
        $validate->setRules($rules);

        if(!$validate->run()){
            $error["error"] = $validate->getMessage();
            view("view/input", $error);
        }else{
            view('view/confirm', $request->getPostAll());
        }

    }
}