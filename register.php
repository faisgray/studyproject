<?php
require_once 'core/init.php';
if(input::exists()){
  if(token::check(input::get('token'))){
  
  $validate = new validate();
  $validation = $validate->check($_POST,array(
    'username' =>array(
      'required' => true,
      'min' => 2,
      'max' => 20,
      'correction' => '/[.co]',
      'unique' => 'users'),
      
      'password' =>array(
        'required' => true,
        'min' => 6),
        'password_again' =>array(
          'required' => true,
          'matches' => 'password'),

          'name' =>array(
            'required' => true,
            'min' => 2,
            'max' => 20),
          ));
          if($validation->passed()){
           
            $user = new user();
            $salt=hash::salt(5);
            
          try{
            $user->create(array(
              'username' =>input::get('username'),
              'password' =>hash::make(input::get('password'),$salt),
              'salt' => $salt,
              'name'=>input::get('name'),
              'joined' => date('y-m-d H:i:s'),
              'groups'=>1
              
            ));
          
            session::flash('home','you registered successfully');
        //  redirect::to('index1.php');
          }
          catch(Exception $e){
          die($e->getMessage());
          }
          
          }
          else{
            //output errors
            foreach($validation->errors() as $error){
              echo $error."<br>";
            }
           
          }
        }
      
}
?>
<form action = "" method = "post">
<div clsss="field">
<label for="username">username</label>
<input type="text" name="username" id="username" value="<?php echo escape(input::get('username')); ?>" autocomplete="off">
</div>
<div clsss="field">
<label for="password">password</label>
<input type="text" name="password" id="password" value="" autocomplete="off">
</div>
<div clsss="field">
<label for="password_again">password_again</label>
<input type="text" name="password_again" id="password_again" value="" autocomplete="off">
</div><div clsss="field">
<label for="name">name</label>
<input type="text" name="name" id="name" value="<?php echo escape(input::get('name')); ?>" autocomplete="off">
</div>
<input type="hidden" name="token" id="token" value="<?php  echo token::generate() ?>">
<input type="submit" value="register" >
</form>