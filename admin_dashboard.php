<?php
session_start();
if(!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') header("Location: admin_login.php");
?>
<!DOCTYPE html>
<html>
<head><link rel="stylesheet" href="assets/css/style.css"><title>Admin Panel</title></head>
<body>
    <div class="navbar" style="background: #333;">
        <h2>Admin Panel</h2>
        <div><a href="manage_apps.php">Applications</a><a href="logout.php">Logout</a></div>
    </div>
    <div class="container">
        <h2>Admin Overview</h2>
        <div class="dashboard-grid">
            <div class="card"><h3>Manage Applications</h3><a href="manage_apps.php" class="btn">View All</a></div>
        </div>
    </div>
</body>
</html>