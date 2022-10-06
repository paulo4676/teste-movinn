<?php
include("../php/Class/User.php");
if(!isset($_POST['submit']) )
{
  insert_user();
}

function  insert_user(){
    $user = new User();
    $user->nome =  $_POST['nome'];
    $user->email =  $_POST['email'];
    $user->senha =  $_POST['senha'];
    if($user->insert()){
        insert_account($user);
    }
}

function insert_account($user){


    $tipo_conta = $_POST['selectcount'];   
}

?>