<?php
/**
 * Created by PhpStorm.
 * User: Ryan
 * Date: 12/04/2019
 * Time: 10:43 SA
 */

if(!isset($_SESSION)){
    session_start();
}
if (!isset($_SESSION['username']) || $_SESSION['auth'] != '1'){
  exit();
}

    require_once '../config.php';
    require_once 'Connection.php';
    $conn = getConnection();
if ($_POST['option'] == 'up'){
    mysqli_query($conn,"UPDATE `user` SET `user` = '".$_POST['user']."',`pass`='".$_POST['pass']."',`name` = '".$_POST['name']."', `ip_address`='".$_POST['ip_address']."' WHERE id = '".$_POST['id']."' ");

}else if($_POST['option'] == 'add'){
//  $user->AddInfo($_POST);
    mysqli_query($conn,"INSERT INTO user SET `user`='".$_POST['user']."', `pass`='".$_POST['pass']."', `name`='".$_POST['name']."', `auth`= 0");
}else if($_POST['option'] == 'del'){
//  $user->DeleteUser($_POST['id']);
    mysqli_query($conn,"DELETE FROM `user` WHERE id = '".$_POST['id']."'");
}

 ?>
