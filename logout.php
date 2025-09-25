<?php
session_start();

// Sab sessions clear kar do
session_unset();
session_destroy();

// Login page par redirect
header("Location: login.php");
exit();
?>
