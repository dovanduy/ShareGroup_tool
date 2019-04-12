<?php
include_once "config.php";

if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['username'])) {
    header("location: login.php");
}

$_SESSION['title'] = "Trang chủ";
include "layout/dashboard.php";
?>

