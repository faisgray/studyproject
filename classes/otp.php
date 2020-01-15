<?php
class otp{
  private $_otpp,
          $_db;
          private function __construct(
            $_db =new db;
          )
  private function make($email){
     $this->_otpp = rand(100000,999999);
     if(!mail::sendmail($email,"$this->_otpp is your reset code",$this->mailcontent())){
       return false;
       die();
     }
     else{
      echo 'mailsent<br>';
      
        $this->_otpp = hash::make($this->_otpp).'<br>';
        session::put('otp',$this->rotp());
      return true;
     }
  }
  public function send($email){
  return $this->make($email);
  }

public function mailcontent(){
  $content="enter this code to reset your dname password<br>";
  $content .="<h1 style='padding:8px;border:1px solid gray;background-color:rgb(220, 222, 220);width:fit-content;letter-spacing:3px;'>".$this->rotp()."</h1>";
  return $content;
}
public function rotp(){
  return $this->_otpp;
}
}

?>