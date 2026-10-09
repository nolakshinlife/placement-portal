<!DOCTYPE html>
<html>
<head><link rel="stylesheet" href="assets/css/style.css"><title>Register</title></head>
<body>
    <div class="auth-box">
        <h2>Student Registration</h2>
        <form action="backend/register.php" method="POST">
            <div class="form-group"><label>Name</label><input type="text" name="name" class="form-control" required></div>
            <div class="form-group"><label>Email</label><input type="email" name="email" class="form-control" required></div>
            <div class="form-group"><label>Password</label><input type="password" name="password" class="form-control" required></div>
            <button type="submit" class="btn" style="width: 100%;">Register</button>
            <p style="margin-top: 15px; text-align: center;"><a href="login.php">Back to Login</a></p>
        </form>
    </div>
</body>
</html>