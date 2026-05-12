<?php 
session_start();

if(!isset($_SESSION['user']) && !isset($_SESSION['admin']) && !isset($_SESSION['agent'])){
    header("Location: index.php");
    exit();
}
?>

<?php include("layout/header.php"); ?>
<?php include("db.php"); ?>

<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow mt-4">
                <div class="card-header">
                    <h5 class="text-primary">
                        Track Your Courier
                        <?php if(isset($_SESSION['agent'])){ ?>
                            (<?= $_SESSION['agent'] ?> Branch)
                        <?php } ?>
                    </h5>
                </div>

                <div class="card-body">

                    <form method="POST">
                        <div class="form-group">
                            <label>Enter Tracking Number</label>
                            <input type="text" name="tracking" class="form-control" placeholder="e.g TRK12345" required>
                        </div>

                        <button type="submit" name="search" class="btn btn-primary">
                            Track Now
                        </button>
                    </form>

                </div>
            </div>

        </div>
    </div>

    <?php
    if(isset($_POST['search'])){

        $tracking = mysqli_real_escape_string($conn, $_POST['tracking']);


        if(isset($_SESSION['agent'])){
            $city = $_SESSION['agent'];

            $query = "SELECT * FROM couriers 
                      WHERE tracking_number='$tracking' 
                      AND (from_city='$city' OR to_city='$city')";
        } else {
            $query = "SELECT * FROM couriers WHERE tracking_number='$tracking'";
        }

        $result = mysqli_query($conn, $query);

        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);
    ?>

    <div class="row justify-content-center mt-5 mb-5">
        <div class="col-md-8">

            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    Tracking Result
                </div>

                <div class="card-body">

                    <p><b>Tracking Number:</b> <?= $row['tracking_number'] ?></p>
                    <p><b>Sender:</b> <?= $row['sender_name'] ?></p>
                    <p><b>Receiver:</b> <?= $row['receiver_name'] ?></p>
                    <p><b>From:</b> <?= $row['from_city'] ?></p>
                    <p><b>To:</b> <?= $row['to_city'] ?></p>

                    <p>
                        <b>Status:</b> 

                        <?php
                        $status = $row['status'];

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

                        <span class="badge badge-<?= $color ?>">
                            <?= $status ?>
                        </span>
                    </p>

                    <button onclick="window.print()" class="btn btn-dark">
                        Print Receipt
                    </button>

                </div>
            </div>

        </div>
    </div>

    <?php 
        } else {
    ?>

    <div class="row justify-content-center mt-4">
        <div class="col-md-6">
            <div class="alert alert-danger text-center">
                ❌ Tracking Number Not Found!
            </div>
        </div>
    </div>

    <?php } } ?>

</div>

<?php include("layout/footer.php"); ?>