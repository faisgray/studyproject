<?php
require_once 'core/init.php';
$user = new user();
if(!$user ->isLoggedin()){
  redirect::to('index.php');
}
if(input::exists()){
  if(token::check(input::get('token'))){
    $validation = new validate();
   $validation = $validation->check($_POST,array(
     'name'=>array(
       'required' => true,
       'min' => 2,
       'max' => 50
     )
     ));
     if($validation->passed()){
       try{
         $user->update(array(
           'name' => input::get('name')
         ));
         session::flash('home','your details have been updated');
         redirect::to('index1.php');
       } catch(Exception $e){
         echo $e->getMessage();
       }
     }else{
       foreach($validation->errors() as $error){
         echo $error.'<br>';
       }
     }
  }
}
?>
<form action="" method="post">
<div class = "field">
<label for="name">Name</label>
<input type="text" name="name" value="<?php echo escape($user->data()->name); ?>">

<input type="submit" value="update">
<input type="hidden" name="token" value="<?php echo token::generate();?>">
</div>
</form>
