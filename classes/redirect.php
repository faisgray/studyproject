<?php
class redirect{
  public static function to($location = null){
    if($location){
      if(is_numeric($location)){
        switch($location){
          case 404:

          header('http/1.0 404 Not Found');
          include 'includes/errors/404.php';
          exit();
        }
      }
      header('Location:'.$location);
      exit();
    }
  }
}
?>