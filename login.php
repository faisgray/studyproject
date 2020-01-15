<?php
require_once 'core/init.php';


if(input::exists()){
  if(token::check(input::get('token'))){
    $validate = new validate();
    $validation=$validate->check($_POST,array(
      'username'=>array('required'=> true),
      'password' => array('required' => true)
    ));
    if($validation->passed()){
    $user = new user();
    $remember = (input::get('remember') === "on")?true:false;
    $login = $user->login(input::get('username'),input::get('password'),$remember);

    if($login){
     redirect::to('index1.php');
    }
    else{
      echo 'please enter valid password';
    }
    }
   
    else {
      //output errors
      foreach($validation->errors() as $error)
      {
        echo "<BR>".$error."<br>";
      }
     
    }
  }
  }
?>

<form action="" method="post">
<div class="field">
<label>username</label>
<input type="text" name=username id="username" autoComplete="off"  value="<?php echo escape(input::get('username'))?>">
</div>
<div class="field">
<label>password</label>
<input type="text" name=password id="password" autoComplete="off" value="">
</div>
<input type="hidden" name="token" value="<?php echo token::generate();?>">
<div class="field">
<label for="remember">
<input type="checkbox" name="remember" id="remember">remember me
</label>
</div>
<input type="submit" value="log in">
</form>