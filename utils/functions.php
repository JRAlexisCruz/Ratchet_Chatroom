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