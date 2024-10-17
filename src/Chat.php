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
        $count=count($this->clients);
        foreach($this->clients as $client){
            $client->send(json_encode(['counter'=>$count]));
        }
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        $data=json_decode($msg,true);
        $data['time']=date('d/m/Y H:i');
        foreach ($this->clients as $client) {
            $client->send(json_encode($data));
        }
    }

    public function onClose(ConnectionInterface $conn) {
        $this->clients->detach($conn);
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";
        $conn->close();
    }

}