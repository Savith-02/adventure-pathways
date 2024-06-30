<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                       // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'geethikasavith@gmail.com';                 // SMTP username
    $mail->Password   = 'tgik ivbp xwtw ebsd';                    // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    if (isset($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) && isset($_POST['name'])) {
        $recipientEmail = $_POST['email'];
        $recipientName = $_POST['name'];
    } else {
        die("Invalid recipient email or name.");
    }

    //Recipients
    $mail->setFrom('geethikasavith@gmail.com', 'Mailer');
    $mail->addAddress($recipientEmail, $recipientName); // Use the recipient's email address and name from the POST request

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Subject Here';
    $mail->Body    = 'Email body here';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}