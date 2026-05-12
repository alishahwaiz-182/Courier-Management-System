<?php 
session_start();
include('db.php');


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

<div class="container-fluid">

    <h3 class="mb-4">
        Reports 
        <?php if(isset($_SESSION['agent'])){ ?>
            (<?= $_SESSION['agent'] ?> Branch)
        <?php } ?>
    </h3>

    <div class="card mb-4">
        <div class="card-body">

            <form method="GET" class="form-inline">

                <input type="date" name="date" class="form-control mr-2">

                <input type="text" name="city" class="form-control mr-2" placeholder="Enter City">

                <button type="submit" class="btn btn-primary mr-2">Filter</button>

                <a href="reports.php" class="btn btn-secondary">Reset</a>

            </form>

        </div>
    </div>

    
    <div class="card">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered">

                    <thead class="bg-primary text-white">
                        <tr>
                            <th>ID</th>
                            <th>Tracking</th>
                            <th>Sender</th>
                            <th>Receiver</th>
                            <th>From</th>
                            <th>To</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>

                    <?php
                    $query = "SELECT * FROM couriers WHERE 1";

                    if(isset($_SESSION['agent'])){
                        $agentCity = $_SESSION['agent'];
                        $query .= " AND (from_city='$agentCity' OR to_city='$agentCity')";
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

                    while($row = mysqli_fetch_assoc($result)){
                    ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><?= $row['tracking_number'] ?></td>
                            <td><?= $row['sender_name'] ?></td>
                            <td><?= $row['receiver_name'] ?></td>
                            <td><?= $row['from_city'] ?></td>
                            <td><?= $row['to_city'] ?></td>
                            <td><?= $row['status'] ?></td>
                        </tr>
                    <?php } ?>

                    </tbody>

                </table>
            </div>

            
            <a href="export.php?date=<?= $_GET['date'] ?? '' ?>&city=<?= $_GET['city'] ?? '' ?>" 
               class="btn btn-success mt-3">
               Download Excel
            </a>

        </div>
    </div>

</div>

<?php include("layout/footer.php"); ?>