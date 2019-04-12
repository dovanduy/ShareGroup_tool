<?php
include "config.php";
include "include/Authenticate.php";

if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['username'])){
    header("location: login.php");
}
$_SESSION['title'] = "Trang chủ";

$auth = new Authenticate();
$auth = new Authenticate();
$auth->login($_SESSION['username'], $_SESSION['password']);
$auth->checkAuth();

if ($auth->getUID() != NULL){
    include "layout/dashboard.php";
}
?>

