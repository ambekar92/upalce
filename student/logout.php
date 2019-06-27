<?php
session_start();


unset($_SESSION['email']);
unset($_SESSION['id']);
unset($_SESSION['firstname']);
unset($_SESSION['profile_img']);


echo "<script> window.location='stulogin.php';</script>";
?>