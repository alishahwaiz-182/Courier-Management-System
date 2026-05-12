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
?>

<?php include("layout/header.php"); ?>
<?php include("db.php"); ?>

<?php
if(isset($_POST['submit'])){

    $sender = mysqli_real_escape_string($conn, $_POST['sender']);
    $receiver = mysqli_real_escape_string($conn, $_POST['receiver']);
    $from = mysqli_real_escape_string($conn, $_POST['from_city']);
    $to = mysqli_real_escape_string($conn, $_POST['to_city']);

    $tracking = "TRK" . strtoupper(uniqid());

    $query = "INSERT INTO couriers (tracking_number, sender_name, receiver_name, from_city, to_city, status)
              VALUES ('$tracking','$sender','$receiver','$from','$to','Pending')";

    mysqli_query($conn, $query);

    header("Location: view_courier.php");
    exit();
}
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Add Courier 
                        <?php if(isset($_SESSION['agent'])){ ?>
                            (<?= $_SESSION['agent'] ?> Branch)
                        <?php } ?>
                    </h6>
                </div>

                <div class="card-body">

                    <form method="POST">

                        <div class="form-group">
                            <label>Sender Name</label>
                            <input type="text" name="sender" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Receiver Name</label>
                            <input type="text" name="receiver" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>From City</label>
                            <input type="text" name="from_city" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>To City</label>
                            <input type="text" name="to_city" class="form-control" required>
                        </div>

                        <button type="submit" name="submit" class="btn btn-primary">
                            Save Courier
                        </button>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

<?php include("layout/footer.php"); ?>