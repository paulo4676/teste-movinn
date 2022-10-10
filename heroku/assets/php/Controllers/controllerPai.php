<?php
require_once("../Class/util.php");
class ControllerPai extends util{
    
    function return_messages($message = null,$type){
        if($type == "success"){
            echo $message;
        }
        if($type == "error"){
            header('HTTP/1.0 500 Internal Server Error');
            die(json_encode($message));
        }
    }


    
}

