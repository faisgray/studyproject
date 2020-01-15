<?php
require_once 'core/init.php';
if(token::check(input::get('token'))){
switch(input::get('case')){
case 'c':
$validate = new validate;
$validation = $validate->check($_POST,
array(
  'chapters' => array(
'required' => true,
'min' => 2,
'max'=> 21,
'nameOrder2' =>true,
  ),
  'subject' =>array(
    'required' => true,
  )
));
if($validation->passed()){
$chapter = strtoupper(trim(input::get('chapters')));
$subject = input::get('subject');
$adddataobj = new addteachercoursecontents();
$resarr = array(token::generate());
$resarr[] = true;  
$resarr[] = $adddataobj->addchap($chapter,$subject);  
  echo  json_encode($resarr);
}
else{
  
  $resarr = array(token::generate());
  $resarr[] = false;
  $resarr[] = 'please enter correct name';
  echo  json_encode($resarr);
}
break;
case 'l':
break;
case 'n':
break;
case 'e':
break;
case 't':
break;
}
}
else {
  $resarr = array(token::generate());
  $resarr[] = false;
  $resarr[] = 'chapter add fails please try again';
  echo  json_encode($resarr);
}
?>
