
<?php

require_once("../Class/ClassPai.php");
class Request extends Pai {

public $filename;
public $classname;
public $functionName;
public $parameters;


function __construct($post)
{
    $this->filename = $post["filename"];
    $this->classname = $post["className"];
    $this->functionName = $post["FunctionName"];
    $this->parameters = $post["data"];
}

function process(){
    $this->RequireAllFilesDrirectory("../Class");
    $this->RequireAllFilesDrirectory("../Controllers");
    $class =  $this->create_class($this->classname);
    if($this->is_null($this->parameters)){
        $class->{$this->functionName}();
    }else{
        $class->{$this->functionName}($this->parameters);
    }
}


function create_class($class_name){
    if($this->is_notnull($class_name)){
       if(class_exists($class_name)) return new $class_name;
    }else{
        return null;
    }
}




}