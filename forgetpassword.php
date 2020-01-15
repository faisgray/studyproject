<?php
 require_once 'core/init.php';  
 if(input::exists()){
  if(token::check(input::get('token'))){
switch(input::get('form_number')){
    case 1:
    {
      $validate = new validate;
      $validation = $validate->check($_POST,array(
      'Remail' => array(
        'required' => true,
        'max'=>30,
        'order'=>FILTER_VALIDATE_EMAIL,
        'correction' => '/.com$/' 
      )));
      if($validation->passed()){
        $user = new user();
        if($user->find(input::get('Remail'))){
          if($user->otpcode())
          {
          $step = 'enterotp';
          $email = input::get('Remail');
          }
        }
        else{
          $leerror="email not found";
        }
      }
      else{
        $errors = $validation->errors();
        if(array_key_exists('Remail',$errors)){
          $leerror = implode(' ',$errors['Remail']);
        }
       }
      }
      break;

       case 2:
       {
        //  validate both fields then proceed for match;
        $step = 'enterotp';
        $email = input::get('Remail');
        $validate = new validate;
        $validation = $validate->check($_POST,array(
        'Remail' => array(
          'required' => true,
          'max'=>30,
          'order'=>FILTER_VALIDATE_EMAIL,
          'correction' => '/.com$/' ),
           'otp' => array(
             'required' => true,
             'max' => 6,
             'digits' => true
           )));
           if($validation->passed()){
          $user = new user;
          if($user->find(input::get('Remail'))){
          if($user->checkotp(input::get('otp'))){
            $code = input::get('otp');
            $step = 'setpass';

          }else{
            $codeerror = 'please enter valid otp';
          }

           }else{
             redirect::to(404);
           }
          }
           else{
            $errors = $validation->errors();
            if(array_key_exists('Remail',$errors)){
              redirect::to(404);
            }
            if(array_key_exists('otp',$errors)){
              $codeerror= implode(' ',$errors['otp']);
            }
           }
       }
       break;
       case 3:
          {
        //  validate both fields then proceed for match;
        $step = 'setpass';
        $email = input::get('Remail');
        $code = input::get('otp');
        $validate = new validate;
        $validation = $validate->check($_POST,array(
        'Remail' => array(
          'required' => true,
          'max'=>30,
          'order'=>FILTER_VALIDATE_EMAIL,
          'correction' => '/.com$/' ),
           'otp' => array(
             'required' => true,
             'min' =>6,
             'max' => 6,
             'digits' => true
           ),
           'sgp'=> array(
            'required' => true,
            'min' => 5,
            'max' => 20
           ),
           'sgcp'=> array(
            'required' => true,
            'matches' => 'sgp',
            'min' => 5,
            'max' => 20
           )
          ));
           if($validation->passed()){
          $user = new user;
          if($user->find(input::get('Remail'))){
          if($user->checkotp(input::get('otp'))){
            $salt = hash::salt(5);
            
          if($user->update(array('password' => hash::make(input::get('sgp'),$salt),'salt' => $salt),$user->data()->id)){
          $step = "info";
          }
          }else{
            redirect::to(404);
          }
        }
        else{
          redirect::to(404);
        }
           }
           else{
            $errors = $validation->errors();
            if(array_key_exists('Remail',$errors)){
              redirect::to(404);
            }
            if(array_key_exists('otp',$errors)){
              redirect::to(404);
            }
            if(array_key_exists('sgcp',$errors)){
              $scperror= implode(' ',$errors['sgcp']);
            }
            if(array_key_exists('sgp',$errors)){
              $sperror= implode(' ',$errors['sgp']);
            }
           }
       }
       break;
    }

  }
 }
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
      <div id="LoginForm" style="height:260px" class="fieldsets">
      <!-- login for innee content -->
      <?php 
      if(!isset($step)){
        ?>
<div class = "sfh">Reset Password</div>
<div class="notice" style="width:260px;color:green;text-align:center;"><p>Code(OTP) will be send to your Email,Please enter your register email</p></div>

      <form onsubmit="return chklfld()" action="" method="post" >
                  <input type="hidden" name="form_number" value="1">
            <div class="infb" >

          <input type="text" name="Remail" id="lge" class="inf" placeholder="Email address" 
                  value="<?php echo input::get('Remail') ?>" onblur="validate(this.id)">
                      <div class="tooltip" >
                                <div class="tttxt" id="lgee"><?php if(isset($leerror)){echo $leerror;} ?></div>
                                <div class="downwardarrow"></div>
                      </div>
            </div>
            
           <input type="hidden" name="token" value="<?php echo $token; ?>"> 
           <input type="submit" name="sendemail" value="send Email" class="button">
      </form>
      <?php
      }
      else if(isset($step) && $step == 'enterotp'){
        ?>
        <div class = "sfh">ENTER CODE</div>
<div class="notice" style="width:260px;color:green;text-align:center;"><p>please enter your (OTP)Code,we have alredy sent it to your registed email</p><em style="color:red;">OTP(code) will expire is next 10 minutes.</em></div>

      <form onsubmit="return chklfld()" action="" method="post" >
                  <input type="hidden" name="form_number" value="2">
                  <input type="hidden" name="Remail" value="<?php echo $email; ?>">
            <div class="infb" >
                  <input type="text" name="otp" id="lge" class="inf" placeholder="_" 
                  value="" maxlength="6">
                      <div class="tooltip" >
                                <div class="tttxt" id="lgee"><?php if(isset($codeerror)){ echo $codeerror;}?></div>
                                <div class="downwardarrow"></div>
                      </div>
            </div>
            
                  <input type="hidden" name="token" value="<?php echo $token ?>"> 
                  <input type="submit" name="check" value="Check" class="button">
      </form>

      <?php
        
      }

      else if(isset($step) && $step == 'setpass'){
?>

<div class = "sfh">NEW PASSWORD</div>
<div class="notice" style="width:260px;color:green;text-align:center;"><p>please enter new password</p></div>

      <form onsubmit="return chklfld()" action="" method="post" >
                  <input type="hidden" name="form_number" value="3">
                  <input type="hidden" name="Remail" value="<?php echo $email; ?>">
                  <input type="hidden" name="otp" id="lge" class="inf" placeholder="_" 
                  value="<?php echo $code ?>" maxlength="6">

                  <div class="infb">
                <div id="pscntnr">
                <input type="password" name="sgp" class="inf" id="sgp" placeholder="new Password"
                   onblur="validate(this.id)" min="5" onfocus="eborder(this.id)">
                  <div class="tooltip" >
                    <div class="tttxt" id="sgpe"><?php if(isset($sperror)){ echo $sperror;} ?></div>
                    <div class="downwardarrow"></div>
                 </div>
                  <div id="puh"><img src="style/images/puh.png" height="18px" width="auto" id="sym" onclick="punh('puh')"></div>
                  </div>
                  </div>

                  <div class="infb">
                <div id="pscntnr">
                <input type="password" name="sgcp" class="inf" id="sgcp" placeholder="confirm Password"
                   onblur="validate(this.id)" min="5" onfocus="eborder(this.id)">
                  <div class="tooltip" >
                    <div class="tttxt" id="sgcpe"><?php if(isset($scperror)){ echo $scperror;} ?></div>
                    <div class="downwardarrow"></div>
                 </div>
                  </div>
                  </div>
            
                  <input type="hidden" name="token" value="<?php echo $token ?>"> 
                  <input type="submit" name="change" value="change" class="button">
      </form>
      <?php
      }
      else if(isset($step) && $step == 'info'){
?>

<div id="smily" style="text-align:center;"> <img  src="/style/images/smile.png"></div>
<div class = "sfh" style="text-align:center;margin-top:45px;">PASSWORD CHANGED</div>
<div class="notice" style="width:260px;color:green;text-align:center;margin:auto;"><em style="text-align:center;">password has been changed successfully</em></div>
  <?php
      }
      ?>
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