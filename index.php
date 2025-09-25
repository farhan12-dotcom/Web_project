<?php
session_start();
include "db.php";

$loggedIn = isset($_SESSION['user_id']);

if ($loggedIn) {
    $user_id = $_SESSION['user_id'];
    $name = $_SESSION['name'];

    // User ki uploaded images nikalna
    $sql = "SELECT * FROM images WHERE user_id='$user_id' ORDER BY uploaded_at DESC";
    $result = $conn->query($sql);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>MyImages</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="style.css"> <!-- ye hamesha bootstrap ke niche -->

</head>
<body class="bg-light">

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold" href="index.php">MyImages</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav ms-auto">
        <?php if ($loggedIn): ?>
          <li class="nav-item"><a class="nav-link active" href="index.php">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="upload.php">Upload</a></li>
          <li class="nav-item"><a class="nav-link" href="profile.php">Profile</a></li>
          <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
        <?php else: ?>
         
          <li class="nav-item"><a class="nav-link active" href="index.php">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="upload.php">Upload</a></li>
          <li class="nav-item"><a class="nav-link" href="profile.php">Profile</a></li>
          <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-5">

  <?php if ($loggedIn): ?>
    <h3 class="mb-4 text-center">Your Uploaded Images</h3>
    <div class="row">
      <?php  
      if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) { ?>
              <div class="col-md-3 mb-3">
                  <div class="card shadow-sm">
                      <img src="<?php echo $row['image_path']; ?>" 
                           class="gallery-img card-img-top"
                           data-bs-toggle="modal" 
                           data-bs-target="#imageModal" 
                           onclick="showImage(this)">
                      <div class="card-body">
                          <h6><?php echo htmlspecialchars($row['title']); ?></h6>
                          <small class="text-muted"><?php echo htmlspecialchars($row['tags']); ?></small>
                      </div>
                  </div>
              </div>
      <?php } 
      } else { ?>
          <p class="text-center">No images uploaded yet.</p>
      <?php } ?>
    </div>

  <?php else: ?>
    <div class="text-center mt-5">
      <h1 class="fw-bold">Welcome to MyImages 📷</h1>
      <p class="lead">Upload, manage, and view your favorite images anytime.</p>
      <a href="login.php" class="btn btn-primary btn-lg m-2">Login</a>
      <a href="signup.php" class="btn btn-success btn-lg m-2">Signup</a>
    </div>
  <?php endif; ?>

</div>

<!-- Image Preview Modal -->
<div class="modal fade" id="imageModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content bg-dark">
      <div class="modal-body text-center">
        <img id="modalImage" src="" class="img-fluid rounded">
      </div>
    </div>
  </div>
</div>

<script>
function showImage(imgElement) {
    document.getElementById("modalImage").src = imgElement.src;
}
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> 
</body>
</html>
