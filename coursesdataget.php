<?php
require_once 'core/init.php';
$getcdata = new coursesdata();
echo $getcdata->cdataget($_POST['chapter']);
?>