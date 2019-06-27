<?php
session_start();


unset($_SESSION['admin_email']);
/* unset($_SESSION['id']);
unset($_SESSION['firstname']);
unset($_SESSION['profile_img']); */


echo "<script> window.location='login.php';</script>";
?>