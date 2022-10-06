<?php
class Banco
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
    function queryTable($query)
    {
        $this->connection = pg_connect("{$this->connstring}") or die("Connection failed: " . pg_last_error());
        $result = pg_query($query) or die("Query failed: " . pg_last_error());
        $fetch = pg_fetch_all($result);
        return $fetch;
    }
    function queryArray($query)
    {
        $this->connection = pg_connect("{$this->connstring}") or die("Connection failed: " . pg_last_error());
        $result = pg_query($query) or die("Query failed: " . pg_last_error());
        $fetch = pg_fetch_assoc($result);
        return $fetch;
    }
    public function queryTrueFalse($query)
    {
        $this->connection = pg_connect("{$this->connstring}") or die("Connection failed: " . pg_last_error());
        $result = pg_query($query) or die("Query failed: " . pg_last_error());
        $fetch = pg_fetch_row($result);
        if ($fetch[ 0] == 't') {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    private $connstring;
    private $connection;
}
