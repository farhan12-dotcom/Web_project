<?php
session_start();
include "db.php";

// Agar user login nahi hai to login page pe bhej do
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Database se sirf logged in user ki images fetch karo
$sql = "SELECT * FROM images WHERE user_id = '$user_id' ORDER BY uploaded_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>My Images - Home</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="style.css" rel="stylesheet">
</head>
<body>

<!-- ✅ Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold" href="home.php">MyImages</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link active" href="home.php">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="upload.php">Upload</a></li>
        <li class="nav-item"><a class="nav-link" href="profile.php">Profile</a></li>
        <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
      </ul>
    </div>
  </div>
</nav>


<!-- ✅ Image Gallery -->
<div class="container mt-4">
  <div class="row" id="gallery">
    <?php while ($row = $result->fetch_assoc()) { ?>
      <div class="col-md-4 mb-4 gallery-card" 
           data-title="<?= htmlspecialchars($row['title']) ?>" 
           data-tags="<?= htmlspecialchars($row['tags']) ?>">
        <div class="card shadow">
          <img src="<?= $row['image_path'] ?>" class="card-img-top img-fluid" 
               alt="<?= htmlspecialchars($row['title']) ?>"
               data-bs-toggle="modal" 
               data-bs-target="#imageModal"
               data-img="<?= $row['image_path'] ?>"
               data-title="<?= htmlspecialchars($row['title']) ?>"
               data-tags="<?= htmlspecialchars($row['tags']) ?>">
          <div class="card-body">
            <h5 class="card-title"><?= htmlspecialchars($row['title']) ?></h5>
            <p class="card-text text-muted"><?= htmlspecialchars($row['tags']) ?></p>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>
</div>

<!-- ✅ Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-title"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body text-center">
        <img id="modal-img" class="img-fluid rounded">
        <p id="modal-tags" class="mt-2 text-muted"></p>
      </div>
    </div>
  </div>
</div>

<!-- ✅ Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="script.js"></script>

</body>
</html>
