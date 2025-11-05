<?php
// login.php
session_start();
require_once 'db_connect.php'; // <-- your connection file

/* Only handle POST from login.html
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  header('Location: login.html');
  exit();
}*/
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$username = trim($_POST['username']);
$password = $_POST['password'];




// MD5 to match how the password was saved earlier
$hashed = md5($password);

$query = "SELECT id, name FROM admin WHERE name='$username'";
$result = mysqli_query($conn, $query);

if ($row = $result->fetch_assoc()) {
  // success: create session and go to dashboard
  $_SESSION['user_id']  = $row['id'];
  $_SESSION['username'] = $row['name'];
  header('Location: dashboard.php');
  exit();
} else {
  // invalid credentials
  $message = "<div class='alert alert-danger'>Asset added successfully!</div>";
}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>IT Asset Management System - Login</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(135deg, #1d3557, #457b9d);
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      font-family: Arial, sans-serif;
    }
    .login-card {
      background: #fff;
      padding: 2rem;
      border-radius: 15px;
      box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
      width: 100%;
      max-width: 400px;
    }
    .login-card h3 {
      text-align: center;
      margin-bottom: 1.5rem;
      color: #1d3557;
    }
    .btn-custom {
      background-color: #1d3557;
      color: #fff;
      transition: 0.3s;
    }
    .btn-custom:hover {
      background-color: #457b9d;
    }
  </style>
</head>
<body>

  <div class="login-card">
    <h3>IT Asset Management</h3>
    <form action="login.php" method="POST">
      <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" name="username" id="username" class="form-control" placeholder="Enter your username" required>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password" required>
      </div>
      <button type="submit" class="btn btn-custom w-100">Login</button>
    </form>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

