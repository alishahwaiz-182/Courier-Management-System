<?php 
session_start();


if(!isset($_SESSION['admin'])){
    header("Location: index.php");
    exit();
}
?>

<?php include("layout/header.php"); ?>
<?php include("db.php"); ?>

<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Manage Customers
            </h6>
        </div>

        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php
                    $result = mysqli_query($conn, "SELECT * FROM users");

                    while($row = mysqli_fetch_assoc($result)){
                    ?>
                        <tr>
                            <td><?= $row['id'] ?></td>

                            <td><?= $row['name'] ?></td>

                            <td><?= $row['email'] ?></td>

                            <td>
                                
                                <a href="delete_customer.php?id=<?= $row['id'] ?>" 
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('Are you sure?')">
                                   Delete
                                </a>
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