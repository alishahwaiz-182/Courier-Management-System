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

<div class="container-fluid">

    <!-- 🔥 ONLY AGENT BUTTONS -->
    <?php if(isset($_SESSION['agent'])){ ?>
        <div class="mb-3">
            <a href="view_courier.php?type=all" class="btn btn-secondary btn-sm">All</a>
            <a href="view_courier.php?type=send" class="btn btn-success btn-sm">Send</a>
            <a href="view_courier.php?type=receive" class="btn btn-primary btn-sm">Receive</a>
        </div>
    <?php } ?>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                All Couriers 
                <?php if(isset($_SESSION['agent'])){ ?>
                    (<?= $_SESSION['agent'] ?> Branch)
                <?php } ?>
            </h6>
        </div>

        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>ID</th>
                            <th>Tracking</th>
                            <th>Sender</th>
                            <th>Receiver</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php
                    $type = isset($_GET['type']) ? $_GET['type'] : 'all';

                    if(isset($_SESSION['agent'])){
                        $city = $_SESSION['agent'];

                        if($type == "send"){
                            $query = "SELECT * FROM couriers 
                                      WHERE from_city LIKE '%$city%'";
                        }
                        elseif($type == "receive"){
                            $query = "SELECT * FROM couriers 
                                      WHERE to_city LIKE '%$city%'";
                        }
                        else{
                            // ALL (default)
                            $query = "SELECT * FROM couriers 
                                      WHERE from_city LIKE '%$city%' 
                                      OR to_city LIKE '%$city%'";
                        }
                    }
                    else{
                        // ADMIN → FULL DATA
                        $query = "SELECT * FROM couriers";
                    }

                    $result = mysqli_query($conn, $query);

                    while($row = mysqli_fetch_assoc($result)){
                    ?>
                        <tr>
                            <td><?= $row['id'] ?></td>

                            <td><b><?= $row['tracking_number'] ?></b></td>

                            <td><?= $row['sender_name'] ?></td>
                            <td><?= $row['receiver_name'] ?></td>

                            <td>
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

                                <?php if($status == "Delivered"){ ?>
                                    <br>
                                    <button onclick="alert('Delivery SMS Sent!')" 
                                            class="btn btn-success btn-sm mt-1">
                                        Delivery SMS
                                    </button>
                                <?php } ?>
                            </td>

                            <td>

                                <a href="edit_courier.php?id=<?= $row['id'] ?>" 
                                   class="btn btn-info btn-sm">Edit</a>

                                <?php if(isset($_SESSION['admin'])){ ?>
                                    <a href="delete_courier.php?id=<?= $row['id'] ?>" 
                                       class="btn btn-danger btn-sm"
                                       onclick="return confirm('Are you sure?')">
                                       Delete
                                    </a>
                                <?php } ?>

                                <a href="full_view.php?id=<?= $row['id'] ?>" 
                                   class="btn btn-primary btn-sm">View</a>

                                <button onclick="sendSMS()" 
                                        class="btn btn-warning btn-sm">
                                    SMS
                                </button>

                            </td>

                        </tr>
                    <?php } ?>
                    </tbody>

                </table>
            </div>

        </div>
    </div>

</div>

<?php include("layout/footer.php"); ?>

<script>
function sendSMS(){
    alert("SMS Sent to Customer Successfully!");
}
</script>