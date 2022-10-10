<?php
require_once("../Class/util.php");
class Banco extends Util
{
    function __construct()
    {
        $params = parse_ini_file('database.ini');
        if ($params === false) {
            throw new \Exception("Error reading database configuration file");
        }
        // connect to the postgresql database
        $conStr = sprintf("host=%s port=%d dbname=%s user=%s password=%s", 
                $params['host'], 
                $params['port'], 
                $params['database'], 
                $params['user'], 
                $params['password']);
        $this->connstring = $conStr;
        $this->connection = pg_connect("{$this->connstring}") or die("Connection failed: " . pg_last_error());
    }

   public function Insert($TableName,$parameters){
    $this->connection = pg_connect("{$this->connstring}") or die("Connection failed: " . pg_last_error());

    $res = pg_insert($this->connection, $TableName, $parameters);
    if ($res) {
        return true;
    }
    else {
        return false;
    }
   }
   
   public function select($TableName,$condicional){
    $this->connection = pg_connect("{$this->connstring}") or die("Connection failed: " . pg_last_error());
    $res = pg_select($this->connection, $TableName, $condicional);
    if ($res) {
        return $res;
    }
    else {
        return null;
    }
   }

   public function update($TableName,$values,$condicional){
    $this->connection = pg_connect("{$this->connstring}") or die("Connection failed: " . pg_last_error());
    $res = pg_update($this->connection, $TableName,$values,$condicional);
    if ($res) {
        return true;
    }
    else {
        return null;
    }
   }







   public function exist($TableName,$condicional){
    $this->connection = pg_connect("{$this->connstring}") or die("Connection failed: " . pg_last_error());
    $res = pg_select($this->connection, $TableName, $condicional);
    if ($res) {
        return true;
    }
    else {
        return false;
    }
   }




    public function executenonquery($sql,$parameters = null){
        $this->connection = pg_connect("{$this->connstring}") or die("Connection failed: " . pg_last_error());
        $result = pg_prepare($this->connection, "my_query", $sql);

        if($parameters != null){
            $result = pg_execute($this->connection, "my_query", $parameters);
        }else{
            $result = pg_execute($this->connection, "my_query");
        }
       return  $result;
    }

    private $connstring;
    private $connection;
}
    