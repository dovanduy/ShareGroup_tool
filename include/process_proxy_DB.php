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
    mysqli_query($conn,"UPDATE `list_proxy` SET `proxy` = '".$_POST['proxy']."' WHERE id = '".$_POST['id']."' ");

}else if($_POST['option'] == 'add'){
    mysqli_query($conn,"INSERT INTO list_proxy SET `proxy`='".$_POST['proxy']."'");
}else if($_POST['option'] == 'del'){
    mysqli_query($conn,"DELETE FROM `list_proxy` WHERE id = '".$_POST['id']."'");
}

 ?>
