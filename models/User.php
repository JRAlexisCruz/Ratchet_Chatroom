<?php

class User {
    //Atributos
    private $username;
    private $password;
    private $mensaje;

    //Constructor
    public function __construct(){
        $this->username = "";
        $this->password = "";
        $this->mensaje="";
    }

    //Observadores
    public function getUsername(){
        return $this->username;
    }

    public function getPassword(){
        return $this->password;
    }

    public function getMensaje(){
        return $this->mensaje;
    }

    //Modificadores
    public function setUsername($username){
        $this->username = $username;
    }

    public function setPassword($password){
        $this->password = $password;
    }

    public function setMensaje($mensaje){
        $this->mensaje = $mensaje;
    }

    //Propios
    public function inicializar($datos){
        $this->setUsername($datos['username']);
        $this->setPassword($datos['password']);
    }

    public function insertar(){
        $completado=false;
        $db=new DataBase();
        $query="INSERT INTO user(username,password) VALUES ('".$this->getUsername()."','".$this->getPassword()."')";
        if($db->iniciar()){
            if($db->ejecutar($query)){
                $completado=true;
            }else{
                $this->setMensaje($db->getError());
            }
        }else{
            $this->setMensaje($db->getError());
        }
        return $completado;
    }

    public function modificar(){
        $completado=false;
        $db=new DataBase();
        $query="UPDATE user SET password='".$this->getPassword()."' WHERE username='".$this->getUsername()."'";
        if($db->iniciar()){
            if($db->ejecutar($query)>0){
                $completado=true;
            }elseif($db->ejecutar($query)==0){
                $this->setMensaje("0:registros no modificados");
            }else{
                $this->setMensaje($db->getError());
            }
        }else{
            $this->setMensaje($db->getError());
        }
        return $completado;
    }

    public function eliminar(){
        $completado=false;
        $db=new DataBase();
        $query="DELETE FROM user WHERE username='".$this->getUsername()."'";
        if($db->iniciar()){
            if($db->ejecutar($query)){
                $completado=true;
            }else{
                $this->setMensaje($db->getError());
            }
        }else{
            $this->setMensaje($db->getError());
        }
        return $completado;
    }

    public function buscar($username){
        $encontrado=false;
        $db=new DataBase();
        $query="SELECT * FROM user WHERE username='".$username."'";
        if($db->iniciar()){
            $res=$db->ejecutar($query);
            if($res>-1){
                if($res>0){
                    $row=$db->registro();
                    $datos=['username'=>$row['username'],'password'=>$row['password']];
                    $this->inicializar($datos);
                    $encontrado=true;
                }else{
                    $this->setMensaje("No hay usuarios");
                }
            }else{
                $this->setMensaje($db->getError());
            }
        }else{
            $this->setMensaje($db->getError());
        }
        return $encontrado;
    }

    public function listar($condicion=""){
        $db=new DataBase();
        $users=[];
        $query="SELECT * FROM user";
        if($condicion!=""){
            $query.=" WHERE ".$condicion;
        }
        if($db->iniciar()){
            $res=$db->ejecutar($query);
            if($res>-1){
                if($res>0){
                    while($row=$db->registro()){
                        $user=new User();
                        $datos=['username'=>$row['username'],'password'=>$row['password']];
                        $user->inicializar($datos);
                        array_push($users,$user);
                    }
                }else{
                    $this->setMensaje("No hay usuarios");
                }
            }else{
                $this->setMensaje($db->getError());
            }
        }else{
            $this->setMensaje($db->getError());
        }
        return $users;
    }

}