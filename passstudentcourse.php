<?php
 require_once 'core/init.php';
 
 if(input::exists()){
  if(token::check(input::get('token'))){
     $validate = new validate;
     $validation = $validate->check($_POST,array(
       'subject' => array(
         'required' => true,
         'max' => 10,
         'digits' => true,
       )
       ));
       if($validation->passed()){
$data =input::get('subject');
$savecourse = new addstudentcourses();
if($savecourse->addscourse($data)){
  echo json_encode(array('added' => true,'token' => token::generate()));
       }else{
         echo json_encode(array('added' => false,'token' => token::generate()));
       }

   }
 }
}
?>