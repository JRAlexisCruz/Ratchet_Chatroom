<?php

include_once '../../utils/configuracion.php';

$data=data_submitted();
$userController=new UserController();
session_start();

if($data['action']=='login'){
    if($userController->find($data)){
        if($userController->verifyPassword($data)){
            $_SESSION['username']=$data['username'];
            echo("<script>location.href = '../chatroom/index.php';</script>");
        }else{
            $_SESSION['username']=$data['username'];
            $_SESSION['passwordError']=$userController->getMensaje();
            echo("<script>location.href = 'index.php';</script>");
        }
    }else{
        $_SESSION['username']=$data['username'];
        $_SESSION['usernameError']=$userController->getMensaje();
        echo("<script>location.href = 'index.php';</script>");
    }
}else{
    if($userController->find($data)){
        $_SESSION['usernameError']="User already exists";
        $_SESSION['username']=$data['username'];
        echo("<script>location.href = 'register.php';</script>");
    }else{
        if($userController->insert($data)){
            $_SESSION['username']=$data['username'];
            echo("<script>location.href = '../chatroom/index.php';</script>");
        }
    }
}