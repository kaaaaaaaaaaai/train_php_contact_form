<?php
/**
 * Created by PhpStorm.
 * User: kaiogita
 * Date: 2016/09/08
 * Time: 0:54
 */

function view($file_path, $data=null){
    //
    $replaceFilePath = str_replace(".", "/", $file_path);
    //最初に /をつける
    $replaceFilePath = "/{$replaceFilePath}.php";

    if (!file_exists(dirname($_SERVER["SCRIPT_FILENAME"]).$replaceFilePath)){
        throw new HttpException(404,"Method NotFound");
    }

    if (isset($data)){
        extract($data);
    }
    include dirname($_SERVER["SCRIPT_FILENAME"]).$replaceFilePath;
}