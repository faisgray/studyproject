<?php
require_once 'core/init.php';
 
if(session::exists('user')){
  $user = new user();
  if($user->isloggedin()){
  $username = $user->data();
  }
}else{
  redirect::to('index.php');
}
?>

<!DOCTYPE html lang="en">
<html >
<head>
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <!-- common for all -->
  <link rel="stylesheet" href='style/style.css'>
  <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
  <link rel="icon" href="/favicon.ico" type="image/x-icon">
<!-- ////////////////////////////////////////// -->


  
<script>
    function menufun(){
  var menubody = document.getElementById('sidemenu');
  console.log(menubody.style.width);
  if(menubody.style.width !== '0px'){
    
    menubody.style.width = '0px';    
  }else{
    menubody.style.width = innerWidth*(3/4);
    menubody.focus();
  
  }
}
</script>

</head>
<body>
    <div id="sidemenu" style="width:0px" tabindex="0" onblur="menufun()">
        <div class="logocontainer _closelc" onclick='menufun()' >
            <span id=close></span>
          </div>
      <div class="menuhead">
<div class="logocontainer _letterlc">
  <span id="letterlogo"></span>
</div>
<div id="name"><?php echo $username->name; ?></div>
  <span id="profession">DEVLOPER</span>
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
<a href="course.php">
<div class="logocontainer">
  <div id="courselogo"></div>
</div>
</a>
<a href="profile.php">
  <div class="logocontainer">
    <div id="homelogo"></div>
  </div>
  </a>
  </header>