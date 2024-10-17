<?php
class UserController{
    //Atributos
    private $mensaje;

    //Constructor
    public function __construct(){
        $this->mensaje="";
    }

    //Observadores
    public function getMensaje(){
        return $this->mensaje;
    }

    //Modificadores
    public function setMensaje($mensaje){
        $this->mensaje=$mensaje;
    }

    //Propios
    public function find($data){
        $found=false;
        $user = new User();
        if($user->buscar($data['username'])){
            $found=true;
        }else{
            $this->mensaje="User is not registered";
        }
        return $found;
    }

    public function verifyPassword($data){
        $verified=false;
        $user = new User();
        if($user->buscar($data['username'])){
            if($user->getPassword()==$data['password']){
                $verified=true;
            }else{
                $this->mensaje="Incorrect password";
            }
        }
        return $verified;
    }

    public function insert($data){
        $inserted=false;
        $user = new User();
        if($user->buscar($data['username'])){
            $this->mensaje="User already exists";
        }else{
            $user->inicializar($data);
            if($user->insertar()){
                $inserted=true;
            }else{
                $this->mensaje=$user->getMensaje();
            }
        }
        return $inserted;
    }
    
}