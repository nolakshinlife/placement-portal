<?php
session_start();
if(!isset($_SESSION['student_id'])) header("Location: login.php");
require 'config/db.php';

$stmt = $pdo->prepare("SELECT * FROM students WHERE id = ?");
$stmt->execute([$_SESSION['student_id']]);
$student = $stmt->fetch();
?>
<!DOCTYPE html>
<html>
<head><link rel="stylesheet" href="assets/css/style.css"><title>My Profile</title></head>
<body>
    <div class="navbar">
        <h2>Placement Portal</h2>
        <div><a href="dashboard.php">Dashboard</a><a href="jobs.php">Jobs</a><a href="profile.php">Profile</a><a href="logout.php">Logout</a></div>
    </div>
    <div class="container">
        <h2>Academic Profile</h2>
        <?php if(isset($_GET['msg']) && $_GET['msg']=='updated') echo "<div class='alert'>Profile Updated!</div>"; ?>
        <div class="card">
            <form action="backend/update_profile.php" method="POST">
                <div class="form-group"><label>Roll Number</label><input type="text" name="roll_no" class="form-control" value="<?php echo htmlspecialchars($student['roll_no'] ?? ''); ?>" required></div>
                <div class="form-group">
                    <label>Department</label>
                    <select name="department" class="form-control">
                        <option value="BCA" <?php if(($student['department']??'') == 'BCA') echo 'selected'; ?>>BCA</option>
                        <option value="B.Tech" <?php if(($student['department']??'') == 'B.Tech') echo 'selected'; ?>>B.Tech</option>
                    </select>
                </div>
                <div class="form-group"><label>CGPA</label><input type="number" step="0.01" name="cgpa" max="10" min="0" class="form-control" value="<?php echo $student['cgpa']; ?>" required></div>
                <div class="form-group"><label>Active Backlogs</label><input type="number" name="backlogs" min="0" class="form-control" value="<?php echo $student['backlogs']; ?>" required></div>
                <button type="submit" class="btn">Save Profile</button>
            </form>
        </div>
    </div>
</body>
</html>