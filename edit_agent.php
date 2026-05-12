<?php
session_start();
include("db.php");

if(!isset($_SESSION['admin'])){
    header("Location: index.php");
    exit();
}


$id = $_GET['id'];


$result = mysqli_query($conn, "SELECT * FROM agents WHERE id='$id'");
$row = mysqli_fetch_assoc($result);


if(isset($_POST['update'])){

    $username = $_POST['username'];
    $city = $_POST['city'];

    mysqli_query($conn, "UPDATE agents 
        SET username='$username', city='$city' 
        WHERE id='$id'");

    header("Location: manage_agent.php");
    exit();
}
?>

<?php include("layout/header.php"); ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">

            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    Edit Agent
                </div>

                <div class="card-body">

                    <form method="POST">

                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" 
                                   class="form-control"
                                   value="<?= $row['username'] ?>" required>
                        </div>

                        <div class="form-group">
                            <label>City</label>
                            <input type="text" name="city" 
                                   class="form-control"
                                   value="<?= $row['city'] ?>" required>
                        </div>

                        <button type="submit" name="update" class="btn btn-success">
                            Update
                        </button>

                        <a href="manage_agent.php" class="btn btn-secondary">
                            Back
                        </a>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

<?php include("layout/footer.php"); 