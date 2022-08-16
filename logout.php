<?php 
session_start();

session_unset();
session_destroy();
echo '<script>alert("Logout suucessfully")</script>';
header("Location: index.php");

?>