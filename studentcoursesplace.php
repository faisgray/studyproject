<?php 
require_once 'core/init.php';
$coursesobj = new placestudentcourses();

echo json_encode($coursesobj->getsavecourses());

?>