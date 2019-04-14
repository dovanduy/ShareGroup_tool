<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['username']) || $_SESSION['auth'] !=1){
    header("location: login.php");
}
include "config.php";
$_SESSION['title'] = "Log";
include "layout/header.php";

if(isset($_POST['clear'])) {
    file_put_contents("log.log","");
}

?>

<form action="" method="post">
    <button type="submit" class="btn btn-danger" name="clear" id="" value="">Xoá Log</button>
</form>
    <br>

<?php

$file = fopen("log.log","r") or die("Cannot open file ");
while(!feof($file)) {
    echo fgets($file) . "<br>";
}
fclose($file);
?>

