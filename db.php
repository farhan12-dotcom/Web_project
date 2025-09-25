<?php
$servername = "	sql210.infinityfree.com";  // AwardSpace ka DB Host (Control Panel me milta hai)
$username   = "	if0_40022417";            // Jo tumne Database banate waqt diya
$password   = "EbNogH91SRoU9NS";        // Jo password tumne diya
$dbname     = "if0_40022417_images";            // Tumhara Database ka naam

// Connection create karo
$conn = new mysqli($servername, $username, $password, $dbname);

// Connection check karo
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
