<?php
try{
require 'PHPMailer/PHPMailerAutoload.php';
$mail = new PHPMailer(true);

$mail->isSMTP();                            // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';             // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                     // Enable SMTP authentication
$mail->Username = 'studyproj001@gmail.com'; // SMTP username
$mail->Password = 'f5683gill';              // SMTP password
$mail->SMTPSecure = 'tls';                  // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                          // TCP port to connect to

$mail->setFrom('noreply@activation.ikra.com', 'ikra.com',true);
$mail->addReplyTo('noreply@ikra.com', 'ikra.com');
$mail->addAddress('faisgray@gmail.com');   // Add a recipient

$mail->isHTML(true);  // Set email format to HTML

$bodyContent = '<h1>Welcome to join IKRA</h1>';
$bodyContent = '<p>We took a step in order to provide best Education to whole INDIA,THANKS to join IKRA,we will try our best to serve better.have a nice journey along with us.</p><br>';
$bodyContent .= '<p style="color:green">click on this button below in order to activate your IKRA account.</p>';
$bodyContent .='<a href="www.google.com" target="_blank" style="font-size: 16px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; text-decoration: none;border-radius: 3px; padding: 12px 16px; border: 1px solid rgb(219, 137, 5); display: inline-block;background-color:rgb(230, 145, 8);;font-weight:bold">ACTIVATE</a>';

$mail->Subject = 'IKRA account activation';
$mail->Body    = $bodyContent;

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
    return false;
} else {
    echo 'Message has been sent';
    return true;
}
}
catch(phpmailerException $e){
echo $e->getMessage();
}
?>