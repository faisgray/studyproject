<?php
class user{
  private $_db,
          $_data,
          $_sessionName,
          $_isloggedin = false,
          $_otp;

  public function __construct($user = null){
$this->_db = DB::getInstance();
$this ->_sessionName = config::get('session/session_name');
$this->_cookieName = config::get('cookie/cookie_name');
if(!$user){
  if(session::exists($this->_sessionName)){
  $user = session::get($this->_sessionName);
  if($this->find($user)){
    $this->_isloggedin = true;
  }
  else{
    // process logoout;
  }
} 
// we will proceed from here
}
// else {
//   $this->find($user);
// }

  }
  // public function hasPermission($key){
  //   $group = $this->_db->get('groups',array('id','=',$this->data()->groups));
  //   if($group->count()){
  //     echo $permissions = json_decode($group->first()->permission,true);
  //     print_r($permissions);
  //     if($permissions[$key] == true){
  //       return true;
  //     }
  //   }
  //  return false;
  // }
  public function update($fields = array(),$id = null){
    if(!$id && $this->isLoggedin()){
      $id = $this->data()->id;
    }
    if(!$this->_db->update('users',$id,$fields)){
      throw new Exception('there was a problem updating');
    }
    else{
      return true;
    }
  }
// only for create new users;
  public function create($fields = array()){
      
      mail::sendmail($fields['username'],"dname account activation",$this->mailcontent($fields['name'],$fields['token'],$fields['username']));      
      if($this->_db->insert('users',$fields)){
        redirect::to("multiple.php?info=activation&em=".$fields['username']);
      }else{
        redirect::to(404);
      }
  }
  public function otpcode(){
    $this->_otp =(rand(100000,999999));
   mail::sendmail($this->data()->username,"$this->_otp is your reset code",$this->otpmailcontent());    
       $this->_otp = hash::make($this->_otp,$this->data()->salt);
       $this->_db->update('users',$this->data()->id,array("otp"=>$this->_otp));
       session::put('otptime',strtotime('+15mins'));
     return true;
 }

 public function checkotp($otp){
   if(session::get('otptime') > time()){
      if($this->data()->otp == hash::make($otp,$this->data()->salt)){
        return true;
      
    }
      else{
        return false;
      }
}else{
  return false;
}
}
  public function find($user = null){
if($user){
  $field = (is_numeric($user))?'id' :'username';
  $data  = $this->_db->get('users',array($field,'=',$user));
  if($data->count()){
    $this->_data = $data->first();
    return true;
  }
}
return false;
  }
  public function login($username = null,$password = null,$remember = false){
//     if(!$username && !$password && $this->exists()){
//       // $this->exists() return the status of $_data
// session::put($this->_sessionName,$this->data()->id);
//     } else
{
    $user = $this->find($username);
// also put data attach with $username in the $_data var;
    if($user){
      if($this->data()->password === hash::make($password,$this->data()->salt)){
        if($this->data()->activate === '1'){
          session::put($this->_sessionName,$this->data()->id);
          $this->_isloggedin = true;
        //   if($remember){
        //   $hash = hash::unique();
        //   $hashCheck = $this->_db->get('users_session',array('user_id','=',$this->data()->id));
        //   if(!$hashCheck->count()){
        //       $this->_db->insert('users_session',array(
        //         'user_id'=>$this->data()->id,
        //         'hash' =>$hash
        //       ));
        //   }else {
        //     $hash = $hashCheck->first()->hash;
        //   }
        //   cookie::put($this->_cookieName,$hash,config::get('remember/cookie_expiery'));
        // }
       return true;
      //  proceed login only by here;
      } else { 
      mail::sendmail($this->data()->username,'dname account activate',$this->mailcontent($this->data()->name,$this->data()->token,$this->data()->username));
        redirect::to('multiple.php?infoagain=activation&em='.$this->data()->username);
      }
      }
      else {
        // put error for password;
        return 2;
      }
    }else{
    //put error for email;
    return 1;
  }
}
  }

  public function data(){
    return $this->_data;
  }
  public function isloggedin(){
    return $this->_isloggedin;
  }
  public function logout(){
    $this->_db->delete('users_session',array('user_id','=',$this->data()->id));
    session::delete($this->_sessionName);
    cookie::delete($this->_cookieName);
    redirect::to('index.php');
  }
  public function exists(){
    return (!empty($this->_data))?true:false;
  }
  // public function mailcontent($name,$token){
  //   $content = "<h2>Hellow <b style='color:gray'>".$name."</b>!!!,Welcome to join IKRA</h2>";
  //   $content .="<p>We took a step in order to provide best Education to whole INDIA,THANKS to join IKRA,we will try our best to serve better.have a nice journey along with us.</p><br>";
  //   $content .="<p style='color:green'>click on this button below in order to activate your IKRA account.</p>";
  //   $content .="<a href='mahdi.com/f0kl5bc62kg6xcj4/verify.php?acode=".$token."' target='_blank' style='font-size: 16px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; text-decoration: none;border-radius: 3px; padding: 12px 16px; border: 1px solid rgb(219, 137, 5); display: inline-block;background-color:rgb(230, 145, 8);font-weight:bold'>ACTIVATE</a>";
  //   return $content;
  // }
  public function mailcontent($name,$token,$email){
    $content = "<h2>Hellow <b style='color:gray'>".$name."</b>!!!,Welcome to join IKRA</h2>";
    $content .="<p>We took a step in order to provide best Education to whole INDIA,THANKS to join IKRA,we will try our best to serve better.have a nice journey along with us.</p><br>";
    $content .="<p style='color:green'>click on this button below in order to activate your IKRA account.</p>";
    $content .="<form action='mahdi.com/verify.php' target='_blank' method='post'>";
    $content .="<input type='hidden' name='email' value='".$email."'>";
    $content .="<input type='hidden' name='code' value='".$token."'>";
    $content .="<input  style='font-size: 16px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; text-decoration: none;border-radius: 3px; padding: 12px 16px; border: 1px solid rgb(219, 137, 5); display: inline-block;background-color:rgb(230, 145, 8);font-weight:bold' type='submit' name='submit' value='activate'> </form>";
    return $content;



 
  
  }
public function otpmailcontent(){
  $content="enter this code to reset your dname password<br>";
  $content .="<h1 style='padding:8px;border:1px solid gray;background-color:rgb(220, 222, 220);width:fit-content;letter-spacing:3px;'>".$this->_otp."</h1>";
  return $content;
}
}

?>