<?php
session_start();
if(!isset($_SESSION['student_id'])) header("Location: login.php");
require 'config/db.php';

// Fetch quick stats
$stmt = $pdo->prepare("SELECT COUNT(*) FROM applications WHERE student_id = ?");
$stmt->execute([$_SESSION['student_id']]);
$total_applied = $stmt->fetchColumn();
?>
<!DOCTYPE html>
<html>
<head><link rel="stylesheet" href="assets/css/style.css"><title>Dashboard</title></head>
<body>
    <div class="navbar">
        <h2>Placement Portal</h2>
        <div>
    <a href="dashboard.php">Dashboard</a>
    <a href="jobs.php">Jobs</a>
    <a href="applications.php">My Applications</a>
    <a href="profile.php">Profile</a>
    <a href="logout.php">Logout</a>
</div>
    </div>
    <div class="container">
        <h2>Welcome, <?php echo htmlspecialchars($_SESSION['name']); ?>!</h2>
        <div class="dashboard-grid">
            <div class="card"><h3>Applications Submitted</h3><h1><?php echo $total_applied; ?></h1></div>
            <div class="card"><h3>My Profile</h3><a href="profile.php" class="btn">Update Now</a></div>
        </div>
    </div>
</body>
</html>