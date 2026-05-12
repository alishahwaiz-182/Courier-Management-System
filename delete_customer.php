<?php
session_start();
include("db.php");


if(!isset($_SESSION['admin'])){
    header("Location: index.php");
    exit();
}

$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM users WHERE id='$id'");

header("Location: manage_customer.php");
exit();
?>