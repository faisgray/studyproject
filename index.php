<?php
 require_once 'core/init.php';  
 $leerror="";
$lperror="";
$seerror = "";
$sperror = "";
$fnerror = "";
$lnerror = "";
$scperror= "";
$emailerr = "";
$passerr = "";
$err = false;
 if(input::exists()){
  if(token::check(input::get('token'))){
 $validate = new validate;
 if(input::get("form_number") == 1){
$validation = $validate->check($_POST,array(
'email' => array(
  'required' => true,
  'max'=>30,
  'order'=>FILTER_VALIDATE_EMAIL,
  'correction' => '/.com$/'
  
),
'password' => array(
  'required'=> true,
  'correct' =>true
)

));
if($validation->passed()){
  $user = new user();
  $login =$user->login(input::get('email'),input::get('password'));
   if($login === true){
     if($user->data()->status == 's')
  redirect::to('profile.php');
  else if($user->data()->status == 't')
  redirect::to('profilet.php');
}
else if($login === 1){
$emailerr = "please enter valid email";
  }else if($login === 2){
    $passerr = "please enter valid password";
  }
}
else{
  $errors = $validation->errors();
  if(array_key_exists('email',$errors)){
    $leerror = implode(' ',$errors['email']);
  }
  if(array_key_exists('password',$errors)){
    $lperror = implode(' ',$errors['password']);
  }
}
}
 // signup form php
 else if(input::get('form_number') == 2){
   $validation = $validate->check($_POST,array(
     'fName'=> array(
       'required' => true,
       'nameOrder' => true
     ),
     'lName'=> array(
     'required' => true,
     'nameOrder' => true
    ),
     'sge'=> array(
       'required' => true,
       'order' => FILTER_VALIDATE_EMAIL,
       'unique' => 'users',
       'correction' => '/.co$/'
     ),
     'sgp'=> array(
      'required' => true,
      'min' => 5,
      'max' => 20
     ),
     'sgcp'=> array(
      'required' => true,
      'matches' => 'sgp',
     )
     )
    );  
    if($validation->passed()){
      $user = new user();
      $salt = hash::salt(5);
      $activationCode = hash::salt(8);
      try{
        $user->create(array(
          'username' => strtolower(input::get('sge')),
          'password' => hash::make(input::get('sgp'),$salt),
          'salt' => $salt,
           'name' => strtoupper(input::get('fName')." ".input::get('lName')),
           'joined' => date("y-m-d h:i:s"),
           'groups' => 1,
           'token' => $activationCode

        ));
        session::flash('home','you registered successfully');
// redirect::to('verify.php');
      } catch(Exception $e){
        die($e->getMessage());
      }
    } else{
      $errors = $validation->errors();
      if(array_key_exists('sge',$errors)){
        $seerror = implode(' ',$errors['sge']);
      }
      if(array_key_exists('sgp',$errors)){
        $sperror = implode(' ',$errors['sgp']);
      }

      if(array_key_exists('fName',$errors)){
        $fnerror = implode(' ',$errors['fName']);
      }

      if(array_key_exists('lName',$errors)){
        $lnerror = implode(' ',$errors['lName']);
      }

      if(array_key_exists('sgcp',$errors)){
        $scperror = implode(' ',$errors['sgcp']);
      }
      $err = true;
    }
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
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="stylesheet" href="style/style1.css">
  <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
  <link rel="icon" href="/favicon.ico" type="image/x-icon">
  <script src="js/script.js" defer></script>
  <?php
  if($err){
    echo "<script type='text/javascript' src='js/phpcall.js' defer>
    </script>";
  }
  ?>
  <script src="js/valid.js" defer></script>
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
<div id="LoginForm" class="fieldsets">

      <!-- login for innee content -->
<div class = "sfh">Login here</div>
     
      <form onsubmit="return chklfld()" action="" method="post" >
                  <input type="hidden" name="form_number" value="1">
            <div class="infb" >
                  <input type="text" name="email" id="lge" class="inf" placeholder="Email address" 
                  value="<?php echo input::get('email'); ?>" onblur="validate(this.id)">
                      <div class="tooltip" >
                                <div class="tttxt" id="lgee"><?php echo $leerror;echo $emailerr; ?></div>
                                <div class="downwardarrow"></div>
                      </div>
            </div>
            <div class="infb">
                  <input type="password" name="password" id="lgp" class="inf" placeholder="Enter Password"                      onblur="validate(this.id)">
                      <div class="tooltip" >
                          <div class="tttxt" id="lgpe"><?php echo $lperror;echo $passerr; ?></div>
                          <div class="downwardarrow"></div>
                      </div>
            </div>
            <div id="fp"><a href="/forgetpassword.php">Forget Password?</a></div>
            
                  <input type="hidden" name="token" value="<?php echo $token ?>"> 
                  <input type="submit" name="LogIn" value="Log In" class="button" >
      </form>
                <hr width="50%">
  </div>
      
      
      
      
      
      <!-- signup form starts -->
      <div class="_signupContainer">
        <!-- signup button -->
        <button id="supfbtn" onclick="switchb()"><span id="buttontxt">Create New Account</span>
          <div id="dirB">&#10148;</div><br style="clear:both;">
</button>
        <!-- form beigns -->
        <div id="SignupForm" class="fieldsets _sname">
          <div class="sfh">Create New Account
            <div class="infl">It's Simple</div>
            
          </div>
          <form onsubmit="return chksfld()" name="" id="Sgnpform" action="" method="post" >
            <input type="hidden" name="form_number" value="2">
            <div id="fillName">
            <!-- names begins from here -->
              <div class="infb">
                <input type="text" name="fName" class="inf" id="fName" placeholder="First Name" value="<?php echo input::get('fName'); ?>" onfocus="eborder(this.id)" onblur="validate(this.id)"3>
                <div class="tooltip" id="ntt">
                  <div id="fNamee" class="tttxt"><?php echo $fnerror; ?></div>
                  <div class="downwardarrow" id="darr">
                  </div>
                </div>
              </div>

              <div class="infb">
                <input type="text" name="lName" class="inf" id="lName" placeholder="Last Name" value="<?php echo input::get('lName'); ?>" onblur="validate(this.id)" onfocus="eborder(this.id)">
                <div class="tooltip">
                  <div id="lNamee" class="tttxt"><?php echo $lnerror; ?></div>
                  <div class="downwardarrow"></div>
                </div>
               </div>
          </div>
          
              <!-- email goes from here -->
              <div class="infb _e">
                <input type="text" name="sge" class="inf" id="sge" placeholder="Email Adress" value="<?php echo input::get('sge'); ?>"
                   onblur="validate(this.id)" onfocus="eborder(this.id)">
                  <div class="tooltip" >
                    <div class="tttxt" id="sgee"><?php echo $seerror; ?></div>
                    <div class="downwardarrow"></div>
                  </div>
              </div>
              <div class="infb">
                <div id="pscntnr">
                <input type="password" name="sgp" class="inf" id="sgp" placeholder="Password"
                   onblur="validate(this.id)" min="5" onfocus="eborder(this.id)">
                  <div class="tooltip" >
                    <div class="tttxt" id="sgpe"><?php echo $sperror; ?></div>
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
                    <div class="tttxt" id="sgcpe"><?php echo $scperror; ?></div>
                    <div class="downwardarrow"></div>
                 </div>
                  </div>
                  </div>

                  <input type="hidden" name="token" value="<?php echo $token ?>"> 
              <input type="submit" name="SignUp" id="sgup" value="Sign Up" class="button" >

          </form>
          <hr width="50%">
          <!-- continue with google button -->
          <div id="cwgc">
            <span id="cwg">Continue with Google</span>
            <span id="gl"></span></div>
        </div>
      </div>

<!-- entryContainer -->
</div>
<script>
  if(!navigator.cookieEnabled){
    // console.log(navigator.cookieEnabled);
document.getElementById('entryContent').style.display="none";
document.getElementsByClassName('errordiv')[0].style.display="block";
  }else{
    // console.log(navigator.cookieEnabled);
    document.getElementById('entryContent').style.display="block";
document.getElementsByClassName('errordiv')[0].style.display="none";
  }</script>
<!-- whole page container -->
  </div>
</body>

</html>