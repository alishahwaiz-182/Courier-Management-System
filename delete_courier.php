<?php
include("db.php");

$id = mysqli_real_escape_string($conn, $_GET['id']);

mysqli_query($conn, "DELETE FROM couriers WHERE id='$id'");

header("Location: view_courier.php");
exit();
?>