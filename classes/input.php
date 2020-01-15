<?php
class input{
  public function exists($method="post"){
    switch($method){
      case "post":
      return (!empty($_POST))?true:false;
      
      break;
      case "get":
      return (!empty($_GET))?true:false;
      break;
    }
  }
  public static function get($item){
  if(isset($_POST[$item])){
  return $_POST[$item];
  }
  else if(isset($_GET[$item])){
    return $_GET[$item];
  }
}
}


?>
