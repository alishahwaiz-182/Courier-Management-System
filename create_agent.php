<?php
session_start();
include("db.php");

if(!isset($_SESSION['admin'])){
    header("Location: index.php");
    exit();
}

if(isset($_POST['add'])){

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $city = mysqli_real_escape_string($conn, $_POST['city']);

    mysqli_query($conn, "INSERT INTO agents (username,password,city)
    VALUES ('$username','$password','$city')");

    echo "<script>alert('Agent Created Successfully')</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Create Agent</title>

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

        <div class="fb-title">Courier System</div>
        <div class="fb-subtitle">Create New Agent</div>

        <form method="POST">

            <input type="text" name="username" class="form-control" placeholder="Username" required>

            <input type="password" name="password" class="form-control" placeholder="Password" required>

            <input type="text" name="city" class="form-control" placeholder="City (Branch)" required>

            <button type="submit" name="add" class="btn btn-fb">
                Create Agent
            </button>

        </form>

        <div class="login-link">
            <a href="dashboard.php">Back to Dashboard</a>
        </div>

    </div>

</div>

</body>
</html>