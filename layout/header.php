<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Courier Management System</title>

    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
</head>

<body id="page-top">

<div id="wrapper">

<!-- SIDEBAR -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-text mx-1">
            Courier System <br>
            <small>
                <?php 
                if(isset($_SESSION['admin'])) echo "Admin";
                elseif(isset($_SESSION['agent'])) echo "Agent";
                elseif(isset($_SESSION['user'])) echo "User";
                ?>
            </small>
        </div>
    </a>

    <hr class="sidebar-divider">

    <?php if(isset($_SESSION['admin']) || isset($_SESSION['agent'])) { ?>

        <li class="nav-item">
            <a class="nav-link" href="dashboard.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                Dashboard
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="add_courier.php">
                <i class="fas fa-fw fa-plus"></i>
                Add Courier
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="view_courier.php">
                <i class="fas fa-fw fa-box"></i>
                View Couriers
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="reports.php">
                <i class="fas fa-fw fa-file"></i>
                Reports
            </a>
        </li>

    <?php } ?>

    <?php if(isset($_SESSION['admin'])) { ?>

        <hr class="sidebar-divider">
        <div class="sidebar-heading">Admin Panel</div>

        <li class="nav-item">
            <a class="nav-link" href="create_agent.php">
                <i class="fas fa-user-plus"></i>
                Create Agent
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="manage_agent.php">
                <i class="fas fa-users"></i>
                Manage Agents
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="manage_customer.php">
                <i class="fas fa-user"></i>
                Manage Customers
            </a>
        </li>

    <?php } ?>

    <li class="nav-item">
        <a class="nav-link" href="track.php">
            <i class="fas fa-search"></i>
            Track Courier
        </a>
    </li>

    <!-- ❌ LOGOUT REMOVE KAR DIYA -->

    <hr class="sidebar-divider">
</ul>

<!-- CONTENT WRAPPER -->
<div id="content-wrapper" class="d-flex flex-column">

<div id="content">

<!-- NAVBAR -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 shadow">

    <span class="navbar-brand text-primary">
        Courier Management System 
        (<?php 
            if(isset($_SESSION['admin'])) echo "Admin";
            elseif(isset($_SESSION['agent'])) echo "Agent";
            elseif(isset($_SESSION['user'])) echo "User";
        ?>)
    </span>

    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

<ul class="navbar-nav ml-auto">

    <li class="nav-item mr-2">
        <a href="logout.php" class="logout-btn">
            <i class="fas fa-sign-out-alt"></i>
            Log out
        </a>
    </li>

</ul>

<style>
.logout-btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 6px 16px 6px 12px;
    font-size: 18px;
    color: #e74a3b;
    border: 1px solid #e74a3b;
    border-radius: 6px;
    text-decoration: none;
    transition: all 0.2s ease;
}

.logout-btn:hover {
    background-color: #e74a3b;
    color: #fff;
    text-decoration: none;
}
</style>

</nav>