<?php
session_start();
if(!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') header("Location: admin_login.php");
require 'config/db.php';

$query = "SELECT applications.id AS app_id, applications.status, students.name, students.roll_no, students.cgpa, jobs.job_title, companies.company_name FROM applications JOIN students ON applications.student_id = students.id JOIN jobs ON applications.job_id = jobs.id JOIN companies ON jobs.company_id = companies.id";
$apps = $pdo->query($query)->fetchAll();
?>
<!DOCTYPE html>
<html>
<head><link rel="stylesheet" href="assets/css/style.css"><title>Manage Applications</title></head>
<body>
    <div class="navbar" style="background: #333;"><h2>Admin Panel</h2><div><a href="admin_dashboard.php">Dashboard</a><a href="logout.php">Logout</a></div></div>
    <div class="container">
        <h2>Student Applications</h2>
        <?php if(isset($_GET['msg'])) echo "<div class='alert'>Status Updated!</div>"; ?>
        <table>
            <tr><th>Student Name</th><th>Roll No</th><th>CGPA</th><th>Company (Role)</th><th>Update Status</th></tr>
            <?php foreach($apps as $app): ?>
            <tr>
                <td><?php echo htmlspecialchars($app['name']); ?></td>
                <td><?php echo htmlspecialchars($app['roll_no']); ?></td>
                <td><?php echo $app['cgpa']; ?></td>
                <td><?php echo htmlspecialchars($app['company_name'] . ' - ' . $app['job_title']); ?></td>
                <td>
                    <form action="backend/update_status.php" method="POST" style="display:flex; gap:10px;">
                        <input type="hidden" name="app_id" value="<?php echo $app['app_id']; ?>">
                        <select name="status" class="form-control" style="width: 130px; padding: 5px;">
                            <option value="Applied" <?php if($app['status']=='Applied') echo 'selected';?>>Applied</option>
                            <option value="Shortlisted" <?php if($app['status']=='Shortlisted') echo 'selected';?>>Shortlisted</option>
                            <option value="Selected" <?php if($app['status']=='Selected') echo 'selected';?>>Selected</option>
                            <option value="Rejected" <?php if($app['status']=='Rejected') echo 'selected';?>>Rejected</option>
                        </select>
                        <button type="submit" class="btn" style="padding: 5px 10px;">Save</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>