<?php

class DataBase extends PDO
{
  
    private $engine;
    private $host;
    private $db;
    private $user;
    private $pass;
    private $error;
    private $connection;
    private $result;
    private $query;
    private $index;
    private $port;

    //Constructor
    public function __construct()
    {

        $this->engine = 'mysql';
        $this->host = 'localhost';
        $this->db = 'bd_chatroom';
        $this->user = 'root';
        $this->pass = '';
        $this->port = '3306';
        $this->error = "";
        $this->query = "";
        $this->index = -1;

        $dns = $this->engine . ':host=' . $this->host . ';dbname=' . $this->db . ';port=' . $this->port;

        try {
            parent::__construct($dns, $this->user, $this->pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
            $this->connection = true;
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            $this->connection = false;
        }
    }

    //Observadores
    public function getConnection()
    {
        return $this->connection;
    }

    public function getError()
    {
        return $this->error;
    }

    public function getResult()
    {
        return $this->result;
    }

    public function getQuery()
    {
        return $this->query;
    }

    public function getIndex()
    {
        return $this->index;
    }

    //Modificadores
    public function setError($error)
    {
        $this->error = $error;
    }

    public function setResult($result)
    {
        $this->result = $result;
    }

    public function setQuery($query)
    {
        $this->query = $query;
    }

    public function setIndex($index)
    {
        $this->index = $index;
    }

    //Propios
    public function iniciar()
    {
        return $this->getConnection();
    }

    public function ejecutar($query)
    {
        $this->setError("");
        $this->setQuery($query);
        if (stristr($query, "insert")) {
            $resp = $this->insertar($query);
        }

        if (stristr($query, "update")) {
            $resp = $this->modificar($query);
        }

        if (stristr($query, "delete")) {
            $resp = $this->eliminar($query);
        }

        if (stristr($query, "select")) {
            $resp = $this->listar($query);
        }
        return $resp;
    }

    public function insertar($sql)
    {
        try {
            $resultado = parent::query($sql);
        } catch (PDOException $e) {
            $resultado = false;
            $error = $this->errorInfo();
            $this->setError($error[2]);
        }
        return $resultado;
    }

    public function eliminar($sql)
    {
        $affectedRows = -1;
        try {
            $resultado = parent::query($sql);
            $affectedRows = $resultado->rowCount();
        } catch (PDOException $e) {
            $error = $this->errorInfo();
            $this->setError($error[2]);
        }
        return $affectedRows;
    }

    public function modificar($sql)
    {
        $affectedRows = -1;
        try {
            $resultado = parent::query($sql);
            $affectedRows = $resultado->rowCount();
        } catch (PDOException $e) {
            $error = $this->errorInfo();
            $this->setError($error[2]);
        }
        return $affectedRows;
    }

    public function listar($sql)
    {
        $totalRows = -1;
        try {
            $resultado = parent::query($sql);
            $arregloResultado = $resultado->fetchAll(PDO::FETCH_ASSOC);
            $totalRows = count($arregloResultado);
            $this->setResult($arregloResultado);
            $this->setIndex(0);
        } catch (PDOException $e) {
            $error = $this->errorInfo();
            $this->setError($error[2]);
        }
        return $totalRows;
    }

    public function registro()
    {
        $filaActual = false;
        $indiceActual = $this->getIndex();
        if ($indiceActual >= 0) {
            $filas = $this->getResult();
            if ($indiceActual < count($filas)) {
                $filaActual =  $filas[$indiceActual];
                $indiceActual++;
                $this->setIndex($indiceActual);
            } else {
                $this->setIndex(-1);
            }
        }
        return $filaActual;
    }
}