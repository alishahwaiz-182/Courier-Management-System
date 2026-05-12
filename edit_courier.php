<?php
session_start();


if(!isset($_SESSION['admin']) && !isset($_SESSION['agent'])){
    header("Location: index.php");
    exit();
}

include("db.php");


$id = mysqli_real_escape_string($conn, $_GET['id']);


if(isset($_SESSION['agent'])){
    $city = $_SESSION['agent'];

    $result = mysqli_query($conn, 
    "SELECT * FROM couriers 
     WHERE id='$id' AND (from_city='$city' OR to_city='$city')");
} else {
    $result = mysqli_query($conn, "SELECT * FROM couriers WHERE id='$id'");
}

$row = mysqli_fetch_assoc($result);


if(!$row){
    echo "<h3 style='color:red;text-align:center;'>Access Denied!</h3>";
    exit();
}


if(isset($_POST['update'])){

    $sender = mysqli_real_escape_string($conn, $_POST['sender']);
    $receiver = mysqli_real_escape_string($conn, $_POST['receiver']);
    $from = mysqli_real_escape_string($conn, $_POST['from_city']);
    $to = mysqli_real_escape_string($conn, $_POST['to_city']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    
    if(isset($_SESSION['agent'])){
        $city = $_SESSION['agent'];

        $update = "UPDATE couriers 
                   SET sender_name='$sender',
                       receiver_name='$receiver',
                       from_city='$from',
                       to_city='$to',
                       status='$status'
                   WHERE id='$id' 
                   AND (from_city='$city' OR to_city='$city')";
    } else {
    
        $update = "UPDATE couriers 
                   SET sender_name='$sender',
                       receiver_name='$receiver',
                       from_city='$from',
                       to_city='$to',
                       status='$status'
                   WHERE id='$id'";
    }

    mysqli_query($conn, $update);

    header("Location: view_courier.php");
    exit();
}
?>

<?php include("layout/header.php"); ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow mb-4">
                <div class="card-header">
                    <h5>
                        Edit Courier 
                        <?php if(isset($_SESSION['agent'])){ ?>
                            (<?= $_SESSION['agent'] ?> Branch)
                        <?php } ?>
                    </h5>
                </div>

                <div class="card-body">

                    <form method="POST">

                        <div class="form-group">
                            <label>Sender Name</label>
                            <input type="text" name="sender" class="form-control"
                                   value="<?= $row['sender_name'] ?>" required>
                        </div>

                        <div class="form-group">
                            <label>Receiver Name</label>
                            <input type="text" name="receiver" class="form-control"
                                   value="<?= $row['receiver_name'] ?>" required>
                        </div>

                        <div class="form-group">
                            <label>From City</label>
                            <input type="text" name="from_city" class="form-control"
                                   value="<?= $row['from_city'] ?>" required>
                        </div>

                        <div class="form-group">
                            <label>To City</label>
                            <input type="text" name="to_city" class="form-control"
                                   value="<?= $row['to_city'] ?>" required>
                        </div>

                       
                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" class="form-control">

                                <option value="Pending" <?= ($row['status']=="Pending") ? "selected" : "" ?>>
                                    Pending
                                </option>

                                <option value="In Transit" <?= ($row['status']=="In Transit") ? "selected" : "" ?>>
                                    In Transit
                                </option>

                                <option value="Out for Delivery" <?= ($row['status']=="Out for Delivery") ? "selected" : "" ?>>
                                    Out for Delivery
                                </option>

                                <option value="Delivered" <?= ($row['status']=="Delivered") ? "selected" : "" ?>>
                                    Delivered
                                </option>

                            </select>
                        </div>

                        <button type="submit" name="update" class="btn btn-success">
                            Update Courier
                        </button>

                        <a href="view_courier.php" class="btn btn-secondary">
                            Back
                        </a>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

<?php include("layout/footer.php"); ?>