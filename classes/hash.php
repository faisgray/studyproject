<?php
class hash{
  public static function make($string,$salt=''){
    return hash("sha256",$string.$salt);
  }
  public static function salt($length){
    $e = bin2hex(random_bytes($length));    
return $e;
  }
  public static function unique(){
    return self::make(uniqid());
  }
}
?>