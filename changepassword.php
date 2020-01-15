<?php
require_once('core/init.php');

$user = new user();
if(!$user->isLoggedin){
  redirect::to('index1.php');
}
if(input::exists()){
  if(token::check(input::get('token'))){
    $validate = new validate();
    $validation = $validate->check($_POST,array(
      'password_current' => array(
        'required' => true,
        'min' => 6
      ),
      'password_new' => array(
        'required' => true,
        'min' => 6
      ),
      'password_new_again' => array(
        'required' => true,
        'min' => 6,
        'matches' => 'password_new'
      )
    ));
if($validation->passed()){
if(hash::make(input::get('password_current'),$user->data()->salt) !== $user->data()->password){
  echo 'you entered wrong password';
}else{
  $salt = hash::salt(5);
  $user = update(array(
    'password'=> hash::make(input::get('password_new'),$salt),
    'salt' => $salt
  ));
  session::flash('home','your password has been reset');
  redirect::to('index1.php');
}
}else{
  foreach($validation->errors() as $error)
  echo $error.'<br>';
}
  }
}
?>
<form action="" method="post" >
<div class="field">
<label for="password_current">password_current</label>
<input type="password" name="password_current" id="password_current">
</div>
<div class="field">
<label for="password_new">New password</label>
<input type="password" name="password_new" id="password_new">
</div>
<div class="field">
<label for="password_new_again">new password again</label>
<input type="password" name="password_new_again" id="password_new_again">
</div>
<input type="submit" value="change password">
<input type="hidden" name="token" value="<?php echo token::generate(); ?>">
</form> 