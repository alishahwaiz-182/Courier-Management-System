<?php
session_start();
include("db.php");

use PHPMailer\PHPMailer\PHPMailer;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if(isset($_POST['send_otp'])){

    $email = $_POST['email'];

    $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

    if(mysqli_num_rows($check) == 1){

        $otp = rand(100000,999999);

        $_SESSION['otp'] = $otp;
        $_SESSION['email'] = $email;

        $mail = new PHPMailer();

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'alishahwaiz182@gmail.com';   
        $mail->Password = 'irkv vtpi efyz lcgx';      
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('alishahwaiz182@gmail.com', 'Courier System');
        $mail->addAddress($email);

        $mail->Subject = 'OTP Password Reset';
        $mail->Body = "Your OTP is: $otp";

        if($mail->send()){
            header("Location: verify_otp.php");
            exit();
        } else {
            echo "Mail Error!";
        }

    } else {
        $error = "Email not found!";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Forgotten password</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .fb-container {
            width: 100%;
            max-width: 550px;
        }

        .fb-card {
        background: #fff;
        padding: 35px;
        border-radius: 10px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.1);
        }

        .fb-title {
            font-size: 28px;
            font-weight: bold;
            color: #1877f2;
            text-align: center;
        }

        .fb-subtitle {
            text-align: center;
            color: #606770;
            margin: 10px 0px 20px;
        }

        .form-control {
        border-radius: 6px;
        padding: 10px;        
        margin-bottom: 15px;
        border:1px solid black;
        width: 80%;           
        display: block;
        margin-left: auto;   
        margin-right: auto;   
        }

        .btn-fb {
        background: #1877f2;
        color: #ffffff;
        font-weight: bold;
        border-radius: 20px;
        padding: 8px;
        width: 50%;
        display: block;
        margin: 10px auto; 
        border:none;
        }

        .btn-fb:hover {
            background: #166fe5;
        }


    </style>
</head>

<body>

<div class="fb-container">

    <div class="fb-card">

        <div class="fb-title">Find Your Account</div>
        <div class="fb-subtitle">Enter your email address.</div>

        <form method="POST">

            <?php if(isset($error)) echo $error; ?>

            <input type="email" name="email" class="form-control" placeholder="Email address" required>

            <button type="submit" name="send_otp" class="btn btn-fb">
                Continue
            </button>

        </form>

    </div>

</div>

</body>
</html>