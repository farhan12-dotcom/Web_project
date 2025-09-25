<?php
session_start();
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password']; // simple (not secure)

    $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
    if ($conn->query($sql) === TRUE) {
        // Get last inserted user id
        $user_id = $conn->insert_id;

        // Session start kar do
        $_SESSION['user_id'] = $user_id;
        $_SESSION['name'] = $name;

        // Direct profile page par bhej do
        header("Location: profile.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Signup</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
  <script src="script.js"></script>
</head>
<body class="bg-light">

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold" href="index.html">MyImages</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="upload.php">Upload</a></li>
        <li class="nav-item"><a class="nav-link" href="profile.php">Profile</a></li>
        <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
        <li class="nav-item"><a class="nav-link active" href="signup.php">Signup</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- Login Form -->
<div class="d-flex justify-content-center align-items-center vh-100">
  <div class="card p-4 shadow" style="width: 350px;">
    <h3 class="text-center">Sign up</h3>
    <form method="POST">
      <input type="text" name="name" class="form-control mb-3" placeholder="Name" required>
      <input type="email" name="email" class="form-control mb-3" placeholder="Email" required>
      <input type="password" name="password" class="form-control mb-3" placeholder="Password" required>
      <button type="submit" class="btn btn-primary w-100">Sign up</button>
    </form>
    <p class="text-center mt-3">Already have an account? <a href="login.html">Login</a></p>
  </div>
</div>

</body>
</html>

