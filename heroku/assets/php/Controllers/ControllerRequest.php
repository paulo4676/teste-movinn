<?php

require_once("../Class/Request.php");
if(isset($_POST)){ 
    $request = new Request($_POST);
    $request->process();
}







