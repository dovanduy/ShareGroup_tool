<?php
/**
 * Created by PhpStorm.
 * User: Ryan
 * Date: 12/04/2019
 * Time: 8:39 CH
 */

if(!isset($_SESSION)){
    session_start();
}
if (!isset($_SESSION['username'])){
    exit();
}

require_once '../config.php';
require_once 'Connection.php';
$conn = getConnection();

mysqli_query($conn,"UPDATE `user` SET `pass` = '".$_POST['pass']."',`name` = '".$_POST['name']."' WHERE id = '".$_POST['id']."'");
$query= mysqli_query($conn,"SELECT * FROM `user` WHERE id='".$_POST['id']."'");
$row = mysqli_fetch_array($query);
$_SESSION['name'] = $row['name'];