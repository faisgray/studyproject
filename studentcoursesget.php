<?php 
require_once 'core/init.php';
$dataget = new getstudentcourses();
$dataarr = array();
if(!empty($_POST)){
foreach($_POST as $postkey => $postvalue){
  $dataarr[] = $postkey;
  $dataarr[] = '=';
  $dataarr[] = $postvalue;
};
}

echo $dataget->studentcourses($dataarr);

?>