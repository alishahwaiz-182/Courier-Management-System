<?php
session_start();

if(isset($_POST['verify'])){

    if($_POST['otp'] == $_SESSION['otp']){
        header("Location: reset_password.php");
    } else {
        $error = "Invalid OTP!";
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

        <div class="fb-subtitle">Enter your OTP</div>

        <form method="POST">

            <?php if(isset($error)) echo $error; ?>

            <input type="text" name="otp" class="form-control" placeholder="Enter OTP" required>

            <button type="submit" name="verify" class="btn btn-fb">
                Verify
            </button>

        </form>

    </div>

</div>

</body>
</html>