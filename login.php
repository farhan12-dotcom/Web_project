<?php
session_start();
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $_SESSION['user_id'] = $row['id']; 
        $_SESSION['name'] = $row['username'];
          // user session set
        header("Location: profile.php");       // login hone ke baad profile.php
        exit();
    } else {
        $error = "Invalid email or password!";
    }
}
?>
<!-- HTML form yahan rakho -->

 
<!DOCTYPE html>
<html lang="en"> 
<head> 
  <meta charset="UTF-8"> 
  <title>Login</title> 
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"> 
  <link rel="stylesheet" href="style.css">
  <script src="script.js"></script>

</head> 
<body class="bg-light"> 

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold" href="index.php">MyImages</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="upload.php">Upload</a></li>
        <li class="nav-item"><a class="nav-link" href="profile.php">Profile</a></li> 
        <li class="nav-item"><a class="nav-link active" href="login.php">Login</a></li> 
        <li class="nav-item"><a class="nav-link" href="signup.php">Signup</a></li> 
      </ul> 
    </div>
  </div>
</nav>

<!-- Login Form -->
<div class="d-flex justify-content-center align-items-center vh-100">
  <div class="card p-4 shadow" style="width: 350px;">
    <h3 class="text-center">Login</h3>
    <form method="POST">
      <input type="email" name="email" class="form-control mb-3" placeholder="Email" required> 
      <input type="password" name="password" class="form-control mb-3" placeholder="Password" required> 
      <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>
    <p class="text-center mt-3">Don’t have an account? <a href="signup.php">Signup</a></p>
  </div> 
</div> 
 
</body> 
</html>
