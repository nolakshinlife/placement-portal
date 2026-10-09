<?php
session_start();
if(!isset($_SESSION['student_id'])) header("Location: login.php");
require 'config/db.php';

$stmt = $pdo->prepare("SELECT * FROM students WHERE id = ?");
$stmt->execute([$_SESSION['student_id']]);
$student = $stmt->fetch();

$jobs = $pdo->query("SELECT jobs.*, companies.company_name FROM jobs JOIN companies ON jobs.company_id = companies.id")->fetchAll();

function checkEligibility($student, $job) {
    $reasons = [];
    if ($student['cgpa'] < $job['min_cgpa']) $reasons[] = "Requires min " . $job['min_cgpa'] . " CGPA";
    if ($student['backlogs'] > $job['max_backlogs']) $reasons[] = "Max " . $job['max_backlogs'] . " backlogs allowed";
    $depts = array_map('trim', explode(',', $job['eligible_departments']));
    if (!in_array($student['department'], $depts)) $reasons[] = "Branch not eligible";
    return $reasons;
}
?>
<!DOCTYPE html>
<html>
<head><link rel="stylesheet" href="assets/css/style.css"><title>Jobs</title></head>
<body>
    <div class="navbar">
        <h2>Placement Portal</h2>
        <div><a href="dashboard.php">Dashboard</a><a href="applications.php">My Applications</a><a href="logout.php">Logout</a></div>
    </div>
    <div class="container">
        <h2>Active Drives</h2>
        <?php if($student['cgpa'] == 0.00): ?>
            <div class="alert">Please update your profile first to check eligibility!</div>
        <?php endif; ?>
        
        <?php foreach($jobs as $job): 
            $errors = checkEligibility($student, $job);
        ?>
        <div class="card" style="margin-top:20px;">
            <h3><?php echo htmlspecialchars($job['company_name'] . ' - ' . $job['job_title']); ?></h3>
            <p>Package: <?php echo $job['package_lpa']; ?> LPA</p>
            <p>Criteria: <?php echo $job['min_cgpa']; ?> CGPA, <?php echo $job['max_backlogs']; ?> Backlogs, Branches: <?php echo $job['eligible_departments']; ?></p>
            <hr style="margin: 10px 0;">
            
            <?php if(empty($errors) && $student['cgpa'] > 0): ?>
                <form action="backend/apply.php" method="POST">
                    <input type="hidden" name="job_id" value="<?php echo $job['id']; ?>">
                    <button type="submit" class="btn">Apply Now</button>
                </form>
            <?php else: ?>
                <p style="color:red; font-size:14px;"><?php echo implode(" | ", $errors); ?></p>
                <button class="btn" disabled>Not Eligible</button>
            <?php endif; ?>
        </div>
        <?php endforeach; ?>
    </div>
</body>
</html>