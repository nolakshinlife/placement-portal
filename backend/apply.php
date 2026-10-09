<?php
session_start();
require '../config/db.php';

if (!isset($_SESSION['student_id'])) die("Unauthorized");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $job_id = $_POST['job_id'];
    $student_id = $_SESSION['student_id'];

    // 1. Fetch Student Data
    $stmt = $pdo->prepare("SELECT cgpa, backlogs, department FROM students WHERE id = ?");
    $stmt->execute([$student_id]);
    $student = $stmt->fetch();

    // 2. Fetch Job Data
    $stmt2 = $pdo->prepare("SELECT min_cgpa, max_backlogs, eligible_departments FROM jobs WHERE id = ?");
    $stmt2->execute([$job_id]);
    $job = $stmt2->fetch();

    // 3. Server-Side Security Validation (Preventing Inspect Element bypass)
    $depts = array_map('trim', explode(',', $job['eligible_departments']));
    if ($student['cgpa'] < $job['min_cgpa'] || $student['backlogs'] > $job['max_backlogs'] || !in_array($student['department'], $depts)) {
        die("Security Alert: You are not eligible for this job.");
    }

    // 4. Insert Application
    try {
        $stmt3 = $pdo->prepare("INSERT INTO applications (job_id, student_id) VALUES (?, ?)");
        $stmt3->execute([$job_id, $student_id]);
        header("Location: ../applications.php?msg=applied");
    } catch (PDOException $e) {
        die("You have already applied! <a href='../jobs.php'>Go Back</a>");
    }
}
?>