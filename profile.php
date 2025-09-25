<?php
session_start();
include "db.php";

// Agar user login nahi hai to login page pe bhej do
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$name = $_SESSION['name'] ?? "User";

// User ki uploaded images nikalna
$sql = "SELECT * FROM images WHERE user_id='$user_id' ORDER BY uploaded_at DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Profile - MyImages</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
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
        <li class="nav-item"><a class="nav-link active" href="profile.php">Profile</a></li>
        <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-5">
    <div class="card p-4 shadow">
        <h2 class="mb-4 text-center">Welcome to your Profile </h2>
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
                <p class="text-center">You haven’t uploaded any images yet.</p>
            <?php } ?>
        </div>
    </div>
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
