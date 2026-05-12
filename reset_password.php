<?php
session_start();
include("db.php");

if(isset($_POST['reset'])){

    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $_SESSION['email'];

    mysqli_query($conn, "UPDATE users SET password='$pass' WHERE email='$email'");

    session_destroy();

    header("Location: index.php");
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

        
        <div class="fb-subtitle">Enter your New Password</div>

        <form method="POST">

            <input type="password" name="password" class="form-control" placeholder="New Password" required>

            <button type="submit" name="reset" class="btn btn-fb">
                Update
            </button>

            
        </form>

    </div>

</div>

</body>
</html>
