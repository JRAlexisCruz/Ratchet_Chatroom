<?php

include_once '../../models/Database.php';
include_once '../../models/User.php';
include_once '../../controllers/UserController.php';
include_once '../../utils/functions.php';

$data=data_submitted();
$userController=new UserController();
session_start();
$_SESSION['loginStatus']=false;

if($data['action']=='login'){
    $login=$userController->find($data);
    if($login){
        $_SESSION['loginStatus']=true;
        $_SESSION['username']=$data['username'];
    }else{
        $_SESSION['message']=$userController->getMensaje();
    }
}else{
    $registration=$userController->insert($data);
    if($registration){
        $_SESSION['loginStatus']=true;
        $_SESSION['username']=$data['username'];
    }else{
        $_SESSION['message']=$userController->getMensaje();
    }
}

echo("<script>location.href = '../chatroom/index.php';</script>");