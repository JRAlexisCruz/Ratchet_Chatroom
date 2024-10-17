<?php

function data_submitted() {
    $array=[];
    foreach ($_POST as $key => $value){
        $array[$key]=$value;
    }
    foreach($_GET as $key => $value){
        $array[$key]=$value;
    }
    return $array;
}

function autoloader($class_name){
    $directories = array(
        $GLOBALS['ROOT'].'models/',
        $GLOBALS['ROOT'].'controllers/',
    );
    foreach($directories as $directory){
        if(file_exists($directory.$class_name . '.php')){
            include_once($directory.$class_name . '.php');
            return;
        }
    }
}

spl_autoload_register('autoloader');