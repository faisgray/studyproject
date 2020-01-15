<?php
 require_once 'core/init.php';  
 $codeerror="";
 if(input::exists()){
  if(token::check(input::get('token'))){

  }}
$token = token::generate();
?>

<!-- ////////************
******************** -->




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
}
/* mouse over link */
a:hover {
  color:rgb(61, 61, 61);
}
/* selected link */
a:active {
  color:rgb(61, 61, 61);
}
#lge{
padding:10px;
font-size:20px;
width:130px;
letter-spacing:10px;
text-align:center;
}
   </style>
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
<div id="LoginForm" class="fieldsets">

      <!-- login for innee content -->
<div class = "sfh">ENTER CODE</div>
<div class="notice" style="width:260px;color:green;text-align:center;"><p>please enter your (OTP)Code,we have alredy sent it to your registed email</p></div>
      <form onsubmit="return chklfld()" action="" method="post" >
                  <input type="hidden" name="form_number" value="1">
            <div class="infb" >
                  <input type="text" pattern="\d*" name="otp" id="lge" class="inf" placeholder="______" 
                  value="" maxlength="6">
                      <div class="tooltip" >
                                <div class="tttxt" id="lgee"><?php echo $codeerror;?></div>
                                <div class="downwardarrow"></div>
                      </div>
            </div>
            
                  <input type="hidden" name="token" value="<?php echo $token ?>"> 
                  <input type="submit" name="check" value="Check" class="button">
      </form>
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