<?php
include("db.php");

if(isset($_POST['register'])){

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    mysqli_query($conn, "INSERT INTO users (name,email,password)
    VALUES ('$name','$email','$password')");

    header("Location:index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register</title>

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

.login-link a {
    display: block;
    width: 45%;
    margin: 10px auto;
    text-align: center;
    text-decoration: none;
    color: black;
    border: 1px solid #a8929281;
    border-radius: 20px;
    padding: 6px;
}

    </style>
</head>

<body>

<div class="fb-container">

    <div class="fb-card">

        <div class="fb-title">Courier Management System</div>
        <div class="fb-subtitle">Create a new account</div>

        <form method="POST">

            <input type="text" name="name" class="form-control" placeholder="Full Name" required>

            <input type="email" name="email" class="form-control" placeholder="Email address" required>

            <input type="password" name="password" class="form-control" placeholder="New password" required>

            <button type="submit" name="register" class="btn btn-fb">
                Sign Up
            </button>

        </form>

        <div class="login-link">
            <a href="index.php">Already have an account?</a>
        </div>

    </div>

</div>

</body>
</html>