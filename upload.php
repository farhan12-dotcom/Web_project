<?php
session_start();
include "db.php";

// Agar user login nahi hai to login.php pe bhej do
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    // $tags = $_POST['tags']; // Filhal use nahi kar rahe
    $user_id = $_SESSION['user_id'];

    // File Upload Handling
    $fileName = $_FILES["image"]["name"];
    $tmpName = $_FILES["image"]["tmp_name"];
    $targetDir = "uploads/";

    // Unique file name banane ke liye
    $uniqueName = time() . "_" . basename($fileName);
    $targetFile = $targetDir . $uniqueName;

    if (move_uploaded_file($tmpName, $targetFile)) {
        // DB insert
        $sql = "INSERT INTO images (user_id, title,  image_path, uploaded_at) 
                VALUES ('$user_id', '$title',  '$targetFile', NOW())";

        if ($conn->query($sql)) {
            echo "<script>alert('Image Uploaded Successfully!');</script>";
        } else {
            echo "<script>alert('Database Error!');</script>";
        }
    } else {
        echo "<script>alert('File Upload Failed!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Upload</title>
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
        <li class="nav-item"><a class="nav-link active" href="upload.php">Upload</a></li>
        <li class="nav-item"><a class="nav-link" href="profile.php">Profile</a></li>
        <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-5">
  <div class="card p-4 shadow">
    <h3>Upload an Image</h3>
    <form action="" method="POST" enctype="multipart/form-data">
      <input type="file" name="image" class="form-control mb-3" required>
      <input type="text" name="title" class="form-control mb-3" placeholder="Enter title" required>
      
      <button type="submit" class="btn btn-success">Upload</button>
    </form>
  </div>
</div>

</body>
</html>
