<?php
require_once("../Class/util.php");
 class Pai extends Util {
    public $table_name;

    function Insert($class,$Parameters){
        $banco = new Banco();
        $Parameters = (array) $Parameters;
        if($banco->Insert($class->table_name,(array) $Parameters)){
            return true;
        }
        else{
            return false;
        }
    }

    function select($class,$condicional){
        $banco = new Banco();
        $condicional = (array) $condicional;
        return $banco->select($class->table_name,(array) $condicional);
    }

    function update($class,$values,$condicional){
        $banco = new Banco();
        $condicional = (array) $condicional;
        return $banco->update($class->table_name,(array) $values,(array) $condicional);
    }

    function exist($class,$condicional){
        $banco = new Banco();
        $condicional = (array) $condicional;
        return $banco->exist($class->table_name,(array) $condicional);
    }


}