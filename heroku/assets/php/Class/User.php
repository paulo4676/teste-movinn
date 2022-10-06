<?php
include("../php/Class/Banco.php");
 class User {
  // Properties
  public $nome ;
  public $email;
  public $senha;
 
  // Methods
  public  function insert(){
    try {
        $banco = new Banco();
        var_dump($banco->queryArray("select * from usuarios")) ;
    } catch (\PDOException $e) {
        echo $e->getMessage();
    }
  }

  public  function find(){

  }

  public  function delete(){

  }
}
?>