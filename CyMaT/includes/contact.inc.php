<?php

require '../phpmailer/PHPMailerAutoload.php';
require '../phpmailer/class.phpmailer.php';
require '../phpmailer/class.smtp.php';

$email=$_POST['email'];
$comment=$_POST['mesaj'];


$mail=new PHPMailer;

$mail->SMTPOptions = array(
    'ssl' => array(
    'verify_peer' => false,
    'verify_peer_name' => false,
    'allow_self_signed' => true
    )
);

$mail->isSMTP();

$mail->SMTPDegug=2;

$mail->Host = 'smtp.office365.com';
$mail->Port = 587;
$mail->SMTPAuth = true;
$mail->SMTPSecure='STARTTLS';
#$mail->SMTPAutoTLS = false;

$mail->Username='cymat123@outlook.com';
$mail->Password='0812phpmail';

$mail->From='cymat123@outlook.com';
$mail->addAddress('cymat123@outlook.com');

$mail->isHTML(true);
$mail->Subject=$_POST['subiect'];
$newComment='Email sent from: '.$email.'<br>'.' Message: '.$comment;
$mail->Body=$newComment;

if(!$mail->send()){
    echo 'Message could not be sent', $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}