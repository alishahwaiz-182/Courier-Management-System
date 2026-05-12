<?php 
session_start();
include("db.php");

if(isset($_POST['login'])){

    $input = mysqli_real_escape_string($conn, $_POST['login_input']);
    $password = $_POST['password'];

    
    $admin_query = "SELECT * FROM admins WHERE username='$input'";
    $admin_result = mysqli_query($conn, $admin_query);

    if(mysqli_num_rows($admin_result) == 1){

        $admin = mysqli_fetch_assoc($admin_result);

        if(password_verify($password, $admin['password'])){
            $_SESSION['admin'] = $admin['username'];
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Invalid Password!";
        }

    } else {

        
        $agent_query = "SELECT * FROM agents WHERE username='$input'";
        $agent_result = mysqli_query($conn, $agent_query);

        if(mysqli_num_rows($agent_result) == 1){

            $agent = mysqli_fetch_assoc($agent_result);

            if(password_verify($password, $agent['password'])){
                $_SESSION['agent'] = $agent['city']; 
                header("Location: dashboard.php");
                exit();
            } else {
                $error = "Invalid Password!";
            }

        } else {

            
            $user_query = "SELECT * FROM users WHERE email='$input'";
            $user_result = mysqli_query($conn, $user_query);

            if(mysqli_num_rows($user_result) == 1){

                $user = mysqli_fetch_assoc($user_result);

                if(password_verify($password, $user['password'])){
                    $_SESSION['user'] = $user['id'];
                    header("Location: track.php");
                    exit();
                } else {
                    $error = "Invalid Password!";
                }

            } else {
                $error = "User/Admin/Agent not found!";
            }
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Login</title>

<style>
body {
  margin: 0;
  font-family: Arial, sans-serif;
  background: #f0f2f5;
}

.container {
  display: flex;
  justify-content: space-between;
  align-items: center;
  height: 100vh;
  padding: 0 80px;
}


.left {
  max-width: 500px;
}

.logo {
  font-size: 60px;
  color: #1877f2;
  font-weight: bold;
  margin-bottom: 0px;
}


.tagline {
  margin:100px 0px 50px;
  font-size: 70px;       
  font-weight: bold;
  line-height: 1.1;
}

.tagline span {
  color: #1877f2;
}


.right {
  width: 400px;         
  background: #fff;
  padding: 30px;
  border-radius: 12px;
  box-shadow: 0 5px 25px rgba(0,0,0,0.15);
}

input {
  width: 100%;
  padding: 14px;
  margin: 10px 0;
  border-radius: 8px;
  border: 1px solid #ddd;
  font-size: 16px;
}

button {
  width: 100%;
  padding: 14px;
  background: #1877f2;
  color: white;
  border: none;
  border-radius: 8px;
  font-size: 18px;
  cursor: pointer;
}

button:hover {
  background: #166fe5;
}

.link {
  display: block;
  text-align: center;
  margin: 20px 0;   
  color: #1877f2;
  text-decoration: none;
}

.create-btn {
  background: #42b72a;
  margin-top: 10px;
}

.create-btn:hover {
  background: #36a420;
}
form {
  margin-bottom: 10px;
}
hr {
  margin: 20px 0;
}
</style>

</head>

<body>

<div class="container">

 
  <div class="left">
    <div class="logo">Courier System</div>

    <div class="tagline">
      Manag <br>
      e your  <br>
      deliveries <br>
      <span>easily</span>.
    </div>
  </div>

  
  <div class="right">
    <h2 style="text-align:center;">Log in to <br>
    Courier  System
  </h2> 


    <form method="POST">

      <?php if(isset($error)) { ?>
        <div style="color:red; text-align:center;">
          <?= $error ?>
        </div>
      <?php } ?>

      <input type="text" name="login_input" placeholder="Email or Username" required>

      <input type="password" name="password" placeholder="Password" required>

      <button type="submit" name="login">Log in</button>

    </form>

    <a href="forgot_password.php" class="link">Forgotten password?</a>

    <hr>

    <a href="register.php" class="create-btn" 
       style="display:block; text-align:center; text-decoration:none; color:white; padding:14px; border-radius:8px;">
       Create new account
    </a>
  </div>

</div>

</body>
</html>