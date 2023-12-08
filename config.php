<?php
spl_autoload_register(function($class_name){
  $Sfilename = "class".DIRECTORY_SEPARATOR.$class_name.".php";
  if(file_exists($Sfilename)){
    require_once($Sfilename);
  }
})

?>