<?php
/**
 * Created by PhpStorm.
 * User: kaiogita
 * Date: 2016/09/08
 * Time: 0:54
 */

function view($file_path, $data=null){
    if (!is_null($data)){
        extract($data);
    }
    //最初に /をつける
    $replaceFilePath = "/{$file_path}.php";


    if (!file_exists(dirname($_SERVER["SCRIPT_FILENAME"]).$replaceFilePath)){
        throw new HttpException(404,"Method NotFound");
    }

    include dirname($_SERVER["SCRIPT_FILENAME"]).$replaceFilePath;
}

function redirect($file_path, $data=null){
    if (!is_null($data)){
        extract($data);
    }
    $replaceFilePath = "/{$file_path}.php";

    if (!file_exists(dirname($_SERVER["SCRIPT_FILENAME"]).$replaceFilePath)){
        throw new HttpException(404,"Method NotFound");
    }

    include dirname($_SERVER["SCRIPT_FILENAME"]).$replaceFilePath;
}