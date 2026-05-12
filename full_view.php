<?php
session_start();
include("db.php");

if(!isset($_GET['id'])){
    header("Location: view_courier.php");
    exit();
}

$id = intval($_GET['id']);

$result = mysqli_query($conn, "SELECT * FROM couriers WHERE id='$id'");
$data = mysqli_fetch_assoc($result);

if(!$data){
    echo "<h3>No Record Found!</h3>";
    exit();
}
?>

<?php include("layout/header.php"); ?>

<div class="container mt-4 mb-4">

    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h5>Courier Full Details</h5>
        </div>

        <div class="card-body">

            <table class="table table-bordered">

                <tr><th>ID</th><td><?= $data['id'] ?></td></tr>
                <tr><th>Tracking Number</th><td><?= $data['tracking_number'] ?></td></tr>
                <tr><th>Sender Name</th><td><?= $data['sender_name'] ?></td></tr>
                <tr><th>Receiver Name</th><td><?= $data['receiver_name'] ?></td></tr>
                <tr><th>From City</th><td><?= $data['from_city'] ?></td></tr>
                <tr><th>To City</th><td><?= $data['to_city'] ?></td></tr>

                <?php
                $status = $data['status'];

                if($status == "Delivered"){
                    $color = "success";
                } elseif($status == "In Transit"){
                    $color = "info";
                } elseif($status == "Out for Delivery"){
                    $color = "primary";
                } else {
                    $color = "warning";
                }
                ?>

                <tr>
                    <th>Status</th>
                    <td>
                        <span class="badge badge-<?= $color ?>">
                            <?= $status ?>
                        </span>
                    </td>
                </tr>

                <tr><th>Date</th><td><?= $data['created_at'] ?? 'N/A' ?></td></tr>

            </table>

            <a href="view_courier.php" class="btn btn-secondary">Back</a>

        </div>
    </div>

</div>

<?php include("layout/footer.php"); ?>