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


if (isset($_POST['option'])){
    $flag = $_POST['option'];
    switch ($flag){
        case "del_all":
            mysqli_query($conn,"DELETE FROM `list_proxy`");
            break;
        case "up":
            mysqli_query($conn,"UPDATE `list_proxy` SET `proxy` = '".$_POST['proxy']."' WHERE id = '".$_POST['id']."' ");
            break;
        case "add_proxy":
            mysqli_query($conn,"INSERT INTO list_proxy SET `proxy`='".$_POST['proxy']."'");
            break;
        case "del":
            mysqli_query($conn,"DELETE FROM `list_proxy` WHERE id = '".$_POST['id']."'");
            break;
    }
}


 ?>
