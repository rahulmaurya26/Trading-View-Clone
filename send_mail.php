<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

session_start(); // Start session to store OTP

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

function otp($length=4){
    $digit = '';
    for ($i = 0; $i < $length; $i++) {
        $digit .= mt_rand(2, 9);
    }
    return $digit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    $toEmail = $_POST['email'];
    $otp = otp();

    $_SESSION['otp'] = $otp; // Save OTP in session for verification

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'rahulmaurya6055@gmail.com';
        $mail->Password   = 'rpty kdea bvdk iiks';  // App password
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        $mail->setFrom('rahulmaurya6055@gmail.com', 'TradingView Clone');
        $mail->addAddress($toEmail);
        $mail->isHTML(true);
        $mail->Subject = '🔐 Your OTP Code';
        $mail->Body    = "
            <h3>📩 OTP Verification</h3>
            <p>Your OTP: <strong>$otp</strong></p>
            <p>Use this to complete your registration.</p>
            <small>Do not share your OTP with anyone.</small>
        ";

        $mail->send();
        echo "success";
    } catch (Exception $e) {
        echo "error: " . $mail->ErrorInfo;
    }
}
?>
