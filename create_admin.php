<?php
include("db.php");

$username = "admin";
$password = password_hash("12345", PASSWORD_DEFAULT);

mysqli_query($conn, "INSERT INTO admins (username, password) 
VALUES ('$username', '$password')");

echo "Admin Created Successfully!";
?>