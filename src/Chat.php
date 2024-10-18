<?php

namespace MyApp;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
date_default_timezone_set('America/Argentina/Mendoza');

class Chat implements MessageComponentInterface {
    protected $clients;

    public function __construct() {
        $this->clients = new \SplObjectStorage;
        echo "Chat server started\n";
    }

    public function onOpen(ConnectionInterface $conn) {
        $this->clients->attach($conn);
    }

    public function onMessage(ConnectionInterface $conn, $msg) {
        $data=json_decode($msg,true);
        if($data['type']=='message'){
            $data['time']=date('d/m/Y H:i');
            foreach ($this->clients as $client) {
                $client->send(json_encode($data));
            }
        }else{
            $this->clients[$conn]=$data['username'];
            $usernames=[];
            foreach($this->clients as $client){
                $usernames[]=$this->clients[$client];
            }
            $msg=['type'=>'connection','usernames'=>$usernames];
            foreach($this->clients as $client){
                $client->send(json_encode($msg));
            }
        }
    }

    public function onClose(ConnectionInterface $conn) {
        $this->clients->detach($conn);
        $usernames=[];
        foreach($this->clients as $client){
            $usernames[]=$this->clients[$client];
        }
        $msg=['type'=>'connection','usernames'=>$usernames];
        foreach($this->clients as $client){
            $client->send(json_encode($msg));
        }
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";
        $conn->close();
    }

}