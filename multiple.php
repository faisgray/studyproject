<?php 
if(isset($_GET['info'])){
  $information = '<h1 style="color:rgb(33, 133, 80);">Account created successfully</h1><hr>';
  $information .='<p id="para">please activate your account before login<br>Activation mail has been sent to your register email: <b>'.$_GET['em'].'</b></p>';
}elseif(isset($_GET['infoagain'])){
  $information = '<h1 style="color:rgb(33, 133, 80);">Activate your account first</h1><hr>';
  $information .='<p id="para">please activate your account before login<br>Activation mail has been sent to your register email: <b>'.$_GET['em'].'</b></p>';
}
?>


<!DOCTYPE html lang="en">
<html>

<head>
  <meta name="viewport" content="width=device-width,initial-scale=0.9">
  
  <link rel="stylesheet" href="/style/style1.css">
  <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
  <link rel="icon" href="/favicon.ico" type="image/x-icon">
  <script src="/js/script.js" defer></script>
  <!-- <script src="js/valid.js" defer></script> -->
   <!-- <script src="https://apis.google.com/js/platform.js" async defer></script>  -->
   <style>
     .wholepagecontainer{
       padding:20px;
     }
     #entryContent{
       text-align:left;
       width:auto;
       padding:12px;
     }
     #para{
      
      padding:5px;
      font-size:20px;
     }
      a:link {
        color:rgb(61, 61, 61);
}
/* body{
background-image:url("style/images/back.jpg");
} */

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
</head>

<body>
  <div class="wholepagecontainer">
  <div id="logoContainer">
      <img title="namenotfound" id="logo" height='150px' src="/style/images/logo.png">
    </div>
    <!-- form sections starts -->

   
<div id="entryContent" > 
  <div id="smily"> <img  src="/style/images/smile.png"></div>
     <?php echo $information ?>
      <button id="supfbtn"><a href="/index.php" style="text-decoration:none;"><span id="buttontxt">Back to Login</span></a>
          
        </button>
      </div>
  </div> 
</body>

</html>