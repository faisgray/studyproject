<?php
require_once 'core/init.php';

$code =input::get('code');
$email = input::get('email');
$user = new user();
if($user->find($email)){
  if($code == $user->data()->token){
    if(!$user->update(array('activate'=>'1'),$user->data()->id)){
      redirect::to(404);
    }
      
  }else{
    redirect::to(404);
  }

}
?>
<!DOCTYPE html lang="en">
<html>
<head>
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <link rel="stylesheet" href="style/style1.css">
  <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
  <link rel="icon" href="/favicon.ico" type="image/x-icon">
  <script src="js/script.js" defer></script>
  <style>
  /* visited link */
a:visited {
  color:rgb(61, 61, 61);
}
/* mouse over link */
a:hover {
  color:rgb(61, 61, 61);
}
/* selected link */
a:active {
  color:rgb(61, 61, 61);
}

   </style>
  <!-- <script src="js/valid.js" defer></script> -->
   <!-- <script src="https://apis.google.com/js/platform.js" async defer></script>  -->
</head>
<body>
<div class="wholepagecontainer">
    <div id="logoContainer"> <img alt="mf" id="logo" height='150px' src="style/images/logo.png"></div>
     
          <div class="errordiv"><p><h3>Cookies Required</h3>cookies are not enabled on your browser.
            please enable cookies
          </p>
          </div>

    <!-- form sections starts -->
<div id="entryContent">
      <!-- first (login)form outline -->
      <div id="LoginForm" style="height:180px" class="fieldsets">
      <!-- login for innee content -->
<div id="smily" style="text-align:center;"> <img  src="/style/images/smile.png"></div>
<div class = "sfh" style="text-align:center;margin-top:45px;">successfully activated</div>
<div class="notice" style="width:260px;color:green;text-align:center;margin:auto;"><em style="text-align:center;">you can login to your account now</em></div>
                <hr width="50%">
  </div>

  
  <button id="supfbtn"><a href="/index.php" style="text-decoration:none;"><span id="buttontxt">Back to Login</span></a>
      
<!-- entryContainer -->
</div>
<script>
  if(!navigator.cookieEnabled){
    console.log(navigator.cookieEnabled);
document.getElementById('entryContent').style.display="none";
document.getElementsByClassName('errordiv')[0].style.display="block";
  }else{
    console.log(navigator.cookieEnabled);
    document.getElementById('entryContent').style.display="block";
document.getElementsByClassName('errordiv')[0].style.display="none";
  }</script>
<!-- whole page container -->
  </div>
</body>

</html>