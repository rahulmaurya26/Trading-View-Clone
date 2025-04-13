<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userOtp = $_POST['otp'];

    if (isset($_SESSION['otp']) && $userOtp == $_SESSION['otp']) {
        echo "success";
    } else {
        echo "invalid";
    }
}
?>
