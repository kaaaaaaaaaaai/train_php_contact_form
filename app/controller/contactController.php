<?php

namespace App\Controller;

use App\Http\Request;

class contactController{
    public function get_index(){
        //templateを読み込むため
        view("view.input");
    }

    public function post_confirm(){
        $request    = new Request();
        view('view.confirm',$request->getPostAll());
    }
}