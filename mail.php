<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/PHPMailer-master/src/Exception.php';
require 'phpmailer/PHPMailer-master/src/PHPMailer.php';
require 'phpmailer/PHPMailer-master/src/SMTP.php';

function sendEmail($toEmail, $subject, $body, $altBody) {
    $mail = new PHPMailer(true);
    try {
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host       = 'smtp.hostinger.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'admin@natesanecotourism.com';
        $mail->Password   = 'mS4Ehh9&h333oa^M1H';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        $mail->setFrom('admin@natesanecotourism.com', 'Admin');
        $mail->addAddress($toEmail);

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $body;
        $mail->AltBody = $altBody;

        $mail->send();
        return 'Message has been sent';
    } catch (Exception $e) {
        return "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['escplan']) && !empty($_POST['escplan'])) {
    $customerDetails = 'Customer Details:<br/>';
    $customerDetails .= 'Name: ' . htmlspecialchars($_POST['name']) . '<br/>';
    $customerDetails .= 'Mobile Number: ' . htmlspecialchars($_POST['mobileNumber']) . '<br/>';
    $customerDetails .= 'Destination: ' . htmlspecialchars($_POST['destination']) . '<br/>';
    $customerDetails .= 'Check In: ' . htmlspecialchars($_POST['checkIn']) . '<br/>';
    $customerDetails .= 'Check Out: ' . htmlspecialchars($_POST['checkOut']) . '<br/>';

    $response = sendEmail(
        'chinnadurai.metro@gmail.com',
        'Escape Plan Customer Approach',
        $customerDetails,
        strip_tags($customerDetails)
    );

    echo $response;
}
?>
