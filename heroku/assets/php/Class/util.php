<?php
 class Util {

    function returnresponse($response = null,$type){
        if($type == "success"){
            echo json_encode($response);
        }
        if($type == "error"){
            header('Content-Type: application/json; charset=UTF-8');
            die($response);
        }
    }
    
    function is_null($string){
        $result = false;

        if(empty($string)){
            $result = true;
        }

        if(!isset($string)){
            $result = true;
        }

        if($string == ""){
            $result = true;
        }

        if($string == null){
            $result = true;
        }
        return $result;
    }

    function is_notnull($string){
        return !$this->is_null($string);
    } 

    function RequireAllFilesDrirectory($dir){
        $files = glob($dir . '/*.php');
        foreach ($files as $file) {
            require_once($file);   
        }
    }
}