<?php 
require_once 'core/init.php';

if(session::exists('home')){
  echo "<p>".session::flash('home'),"<p>";
}
$user = new user();
if($user->isloggedin()){
  echo 'logged in';

?>
<p>hello<a href="#"><?php echo escape($user->data()->username);?></a></p>
<ul>
<li><a href="logout.php">logout</li>
<li><a href="update.php">update</li>
<li><a href="changepassword.php">change password</li>
</ul>
<?php
}
if($user->hasPermission('admin')){
  echo '<p> you are administrator';
}
else{
  echo "you need to <a href='login.php'>login</a> or <a href='register.php'>register</a>";
}
?>