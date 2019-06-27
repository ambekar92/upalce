<?php
session_start();


unset($_SESSION['email']);
unset($_SESSION['id']);
unset($_SESSION['firstname']);
unset($_SESSION['profile_img']);


echo "<script> window.location='exp_login.php';</script>";
?>