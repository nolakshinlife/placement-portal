<?php
session_start();
if(!isset($_SESSION['student_id'])) header("Location: login.php");
require 'config/db.php';

$stmt = $pdo->prepare("
    SELECT applications.status, applications.applied_on, jobs.job_title, companies.company_name 
    FROM applications 
    JOIN jobs ON applications.job_id = jobs.id 
    JOIN companies ON jobs.company_id = companies.id 
    WHERE applications.student_id = ?
");
$stmt->execute([$_SESSION['student_id']]);
$apps = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html>
<head><link rel="stylesheet" href="assets/css/style.css"><title>My Applications</title></head>
<body>
    <div class="navbar"><h2>Placement Portal</h2><div><a href="dashboard.php">Dashboard</a><a href="jobs.php">Jobs</a></div></div>
    <div class="container">
        <h2>My Applications</h2>
        <table>
            <tr><th>Company</th><th>Role</th><th>Date</th><th>Status</th></tr>
            <?php foreach($apps as $app): ?>
            <tr>
                <td><?php echo htmlspecialchars($app['company_name']); ?></td>
                <td><?php echo htmlspecialchars($app['job_title']); ?></td>
                <td><?php echo date('d M Y', strtotime($app['applied_on'])); ?></td>
                <td><span class="badge <?php echo $app['status']; ?>"><?php echo $app['status']; ?></span></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>