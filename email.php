<?php
require 'PHPMailer/PHPMailerAutoload.php';

session_start();

$email = $_SESSION['email']['email'];
$name = $_SESSION['email']['username'];

$otp = rand(1000,9999);
$_SESSION['otp'] = $otp;

$mail = new PHPMailer;
$mail->isSMTP();                                   // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';                    // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                            // Enable SMTP authentication
$mail->Username = 'costraldorestaurant10@gmail.com';          // SMTP username
$mail->Password = 'albo eaop tewp fivv';					   // SMTP password
$mail->SMTPSecure = 'tls';                         // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                 // TCP port to connect to
$mail->setFrom($email, 'MUSICO');
$mail->addReplyTo($email, 'MUSICO');
$mail->addAddress($email);   
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');

$mail->isHTML(true);  // Set email format to HTML

$bodyContent = "<h1>Welcome <b>$name</b>,</h1>";
$bodyContent .= "<p>You recently requested to reset your password for your account.</p>";
$bodyContent .= "<p>OTP to Reset Password at Default Store view is <b>$otp</b> and is valid for 30 minites.</p>";
$bodyContent .= "<br>";
$bodyContent .= "<p><b>Thanks,<b></p>";
$bodyContent .= "<p>MUSICO </p>";

$mail->Subject = 'Email From MUSICO';
$mail->Body    = $bodyContent;

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    header("location:otp.php");
    // echo "sent";
 
}
?>