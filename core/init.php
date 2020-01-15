<?php

session_name('samajdaaruser');
session_start();
$GLOBALS['config']=array(
  'mysql' => array(
    'host'=>'localhost',
    'username'=>"sproject",
    'password'=>"Spro@123",
    'db'=>"sprojectdb"
  ),
  'phpmailer'=>array(
    'username' =>'studyproj001@gmail.com',
    'password' =>'f5683gill',

  ),
  'remember'=>array(
    'cookie_name'=>'hash',
    'cookie_expiery'=>'604600'
  ),
  'session'=>array(
    'session_name'=>'user',
    'token_name'=>'token'
  )

  );
  spl_autoload_register(function($class){
    require_once 'classes/'.$class.'.php';
  });
  require_once 'function/sanitize.php';

  // if(cookie::exists(config::get('remember/cookie_name')) && !session::exists(config::get('session/session_name'))){
  //   echo $hash = cookie::get(config::get('remember/cookie_name'));
  //   $hashCheck = DB::getInstance()->get('users_session',array('hash','=',$hash));
  //   if($hashCheck->count()){
  //     $user = new user($hashCheck->first()->user_id);
  //   }
  // }