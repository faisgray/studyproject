<?php
require_once 'PHPMailer/PHPMailerAutoload.php';
class mail{
  
  private function setupmail($emailaddr,$subject,$content){
    try{
    $email = new phpmailer(true);
    $email->isSMTP();
    $email->Host = 'smtp.gmail.com';
    $email->SMTPAuth = true;
    $email->Username = config::get('phpmailer/username');
    $email->Password = config::get('phpmailer/password');
    $email->SMTPSecure = 'tls';
    $email->Port = 587;
    $email->setFrom('noreply@notifications.ikra.com','ikra.com');
    $email->addReplyTo('noreply@ikra.com','ikra.com');
    $email->addAddress($emailaddr);
    $email->isHTML(true);
    $email->Subject = $subject;
      $email->Body = $content;
      $email->Send();
      $email->SmtpClose();
  }
  catch(phpmailerException $e){
  redirect::to(404);
  die();
  }
}

public static function sendmail($email,$subject,$content){
  return self::setupmail($email,$subject,$content);
}
}
?>