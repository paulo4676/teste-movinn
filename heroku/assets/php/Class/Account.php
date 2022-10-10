<?php
require_once("../Class/Banco.php");
require_once("../Class/ClassPai.php");
 class Account extends Pai {
  // Properties
  public $conta_id ;
  public $saldo ;
  public $numero_conta;
  public $tipoConta;
  public $table_name = "contas" ;
  public $data_criacao;

  // Methods

  public function SelectAcount($selectfields){
    try {
    return $this->select($this,$selectfields);
    } catch (\PDOException $e) {
        echo $e->getMessage();
    }
  }


  public function InsertAcount($insertfields){
    try {
    return $this->insert($this,$insertfields);
    } catch (\PDOException $e) {
        echo $e->getMessage();
    }
  }

  public function updateAccount($values,$condition){
    try {
    return $this->update($this,$values,$condition);
    } catch (\PDOException $e) {
        echo $e->getMessage();
    }
  }


  public function SelectAcountById($id){
    try {
      $selectfields = new stdClass();
      $selectfields->conta_id = $id;
    return $this->select($this,$selectfields)[0];
    } catch (\PDOException $e) {
        echo $e->getMessage();
    }
  }



  public function SelectAccountType($type){
    $result = new stdClass();
    switch ($type) {
      case "1":
        $result->limite = 600;
        $result->taxa = 2.50;
          break;
      case "2":
        $result->limite = 1000;
        $result->taxa = 0.80;
          break;
    }
    return $result;
  }






}
?>