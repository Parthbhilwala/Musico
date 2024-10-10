<?php
require 'PHPMailer/PHPMailerAutoload.php';

session_start();

$email=$_SESSION['email']['email'];
$name = $_SESSION['username']['username'];

$mail = new PHPMailer;
$mail->isSMTP();                                   // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';                    // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                            // Enable SMTP authentication
$mail->Username = 'costraldorestaurant10@gmail.com';          // SMTP username
$mail->Password = 'albo eaop tewp fivv';	 						   // SMTP password
$mail->SMTPSecure = 'tls';                         // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                 // TCP port to connect to
$mail->setFrom($email, 'MUSICO');
$mail->addReplyTo($email, 'MUSICO');
$mail->addAddress($email);   
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');

$mail->isHTML(true);  // Set email format to HTML

$bodyContent = "<h1>Your Password was changed successfully</h1>";
$bodyContent .= "<p>You password for the MUSICO account <b>$email</b> was just changed.</p>";
$bodyContent .= "<p>If this was $name,then you can safely ignore this email</p>";
$bodyContent .= "<p>If this wasn't your account has been compromised. Please call us</p>";
$bodyContent .= "<p><b>Thanks,<b></p>";
$bodyContent .= "<p>MUSICO  And Team</p>";
$bodyContent .= "<br>";
$bodyContent .= "<small>Contact us on 9408844717</small>";

$mail->Subject = 'Password Reset Successfully';
$mail->Body    = $bodyContent;

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    header("location:login.php");
    // echo "sent";
 
}
?>