<?php
require_once("../Class/Banco.php");
require_once("../Class/ClassPai.php");
 class User extends Pai {
  // Properties
  public $nome ;
  public $email;
  public $senha;
  public $table_name = "usuarios" ;

  // Methods
  public  function InsertUser(){
    try {
      $this->Insert($this);
    } catch (\PDOException $e) {
        echo $e->getMessage();
    }
  }

  public  function SelectUser($selectfields){
    try {
      $this->select($this,$selectfields);
    } catch (\PDOException $e) {
        echo $e->getMessage();
    }
  }


  public function UserExist($selectfields){
    try {
      return $this->exist($this,$selectfields);
    } catch (\PDOException $e) {
        echo $e->getMessage();
    }
  }

}
?>