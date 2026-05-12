<?php
session_start();
include("db.php");


if(!isset($_SESSION['admin']) && !isset($_SESSION['agent'])){
    header("Location: index.php");
    exit();
}

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=report.xls");

$query = "SELECT * FROM couriers WHERE 1";


if(isset($_SESSION['agent'])){
    $city = $_SESSION['agent'];
    $query .= " AND (from_city='$city' OR to_city='$city')";
}


if(isset($_GET['date']) && $_GET['date'] != ''){
    $date = $_GET['date'];
    $query .= " AND DATE(created_at) = '$date'";
}


if(isset($_GET['city']) && $_GET['city'] != ''){
    $city = $_GET['city'];
    $query .= " AND (from_city LIKE '%$city%' OR to_city LIKE '%$city%')";
}

$result = mysqli_query($conn, $query);


echo "ID\tTracking\tSender\tReceiver\tFrom\tTo\tStatus\n";


while($row = mysqli_fetch_assoc($result)){
    echo $row['id']."\t";
    echo $row['tracking_number']."\t";
    echo $row['sender_name']."\t";
    echo $row['receiver_name']."\t";
    echo $row['from_city']."\t";
    echo $row['to_city']."\t";
    echo $row['status']."\n";
}
?>