<?php
require_once 'core/init.php';
 
if(session::exists('user')){
  $user = new user();
  if($user->isloggedin()){
  $username = $user->data()->name;
  }
}else{
  redirect::to('index.php');
}
?>

<!DOCTYPE html lang="en">
<html >
<head>
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <link rel="stylesheet" href='style/style.css'>
  <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
  <link rel="icon" href="/favicon.ico" type="image/x-icon">
  <script>
    function menufun(){
  var body = document.getElementById('sidemenu');
  if(body.style.width !== ''){
    body.style = 'width:';
    
  }else{
    body.style.width = innerWidth*(3/4);
  }
}
</script>

</head>
<body>
    <div id="sidemenu">
        <div class="logocontainer _closelc" onclick='menufun()'>
            <span id=close></span>
          </div>
      <div class="menuhead">
<div class="logocontainer _letterlc">
  <span id="letterlogo"></span>
</div>
<div id="name"><?php echo $username; ?></div>
  
      </div>
      <div class ='menucontent'>
<div class="menuitems" id="Events">Add Event</div>
<div class="menuitems" id="Course">Course</div>
<a href="logout.php"><div class="menuitems" id="Logout">Log Out</div></a>
<div class="menuitems" id="Settings">Settings</div>
      </div>
    </div>
  <header>

<div class="logocontainer" onclick='menufun()'>
  <div id="menulogo"></div>
</div>
<a href="tcourse.php">
<div class="logocontainer">
  <div id="courselogo"></div>
</div>
</a>
<a href="profilet.php">
  <div class="logocontainer">
    <div id="homelogo"></div>
  </div>
  </a>
  </header>