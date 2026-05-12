<?php 
session_start();


if(!isset($_SESSION['admin']) && !isset($_SESSION['agent'])){
    header("Location: index.php");
    exit();
}


if(isset($_SESSION['user'])){
    header("Location: track.php");
    exit();
}

include("db.php");


if(isset($_SESSION['agent'])){
    $city = $_SESSION['agent'];

    $total = mysqli_fetch_assoc(mysqli_query($conn, 
    "SELECT COUNT(*) as total FROM couriers 
     WHERE from_city='$city' OR to_city='$city'"))['total'];

    $delivered = mysqli_fetch_assoc(mysqli_query($conn, 
    "SELECT COUNT(*) as total FROM couriers 
     WHERE status='Delivered' AND (from_city='$city' OR to_city='$city')"))['total'];

    $pending = mysqli_fetch_assoc(mysqli_query($conn, 
    "SELECT COUNT(*) as total FROM couriers 
     WHERE status='Pending' AND (from_city='$city' OR to_city='$city')"))['total'];

    $transit = mysqli_fetch_assoc(mysqli_query($conn, 
    "SELECT COUNT(*) as total FROM couriers 
     WHERE status='In Transit' AND (from_city='$city' OR to_city='$city')"))['total'];

} else {

    $total = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM couriers"))['total'];

    $delivered = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM couriers WHERE status='Delivered'"))['total'];

    $pending = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM couriers WHERE status='Pending'"))['total'];

    $transit = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM couriers WHERE status='In Transit'"))['total'];
}
?>

<?php include("layout/header.php"); ?>

<div class="container-fluid">

    <h3 class="mb-4 text-gray-800">
        Dashboard 
        <?php if(isset($_SESSION['agent'])){ ?>
            (<?= $_SESSION['agent'] ?> Branch)
        <?php } ?>
    </h3>

    <div class="row">

    
        <div class="col-md-3 mb-4">
            <div class="card shadow border-left-primary">
                <div class="card-body">
                    <h5>Total Couriers</h5>
                    <h3><?= $total ?></h3>
                </div>
            </div>
        </div>

        
        <div class="col-md-3 mb-4">
            <div class="card shadow border-left-success">
                <div class="card-body">
                    <h5>Delivered</h5>
                    <h3><?= $delivered ?></h3>
                </div>
            </div>
        </div>

       
        <div class="col-md-3 mb-4">
            <div class="card shadow border-left-warning">
                <div class="card-body">
                    <h5>Pending</h5>
                    <h3><?= $pending ?></h3>
                </div>
            </div>
        </div>

        
        <div class="col-md-3 mb-4">
            <div class="card shadow border-left-info">
                <div class="card-body">
                    <h5>In Transit</h5>
                    <h3><?= $transit ?></h3>
                </div>
            </div>
        </div>

    </div>

</div>

<?php include("layout/footer.php"); ?>