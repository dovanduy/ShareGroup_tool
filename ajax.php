<?php
include "config.php";
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['username'])) {
    header("location: login.php");
}
include_once "include/Connection.php";
$conn = getConnection();
$query = mysqli_query($conn,"SELECT * FROM `user` WHERE `user` = '".$_SESSION['username']."'");
if (!$query){
    include "logout.php";
}
include_once "include/API.php";

set_time_limit(240);

$api = new API();

if (isset($_POST['request'])) {

    switch ($_POST['request']) {

        case "get_token":

            $result = array('uid' => '', 'token' => '');

            $FBData = $api->getTokenWithCookie($_POST['cookie']);

            $result['uid'] = $FBData->user_id;
            $result['token'] = $FBData->token;

            $result = json_encode($result);

            echo $result;

            break;

        case "share_group":

            $cookie = $_POST['cookie'];
            $message = $_POST['message'];
            $link = $_POST['link'];
            $limit = json_decode($_POST['limit']);
            $without_approval = json_decode($_POST['without_approval']);

            $result = $api->shareOnMultipleGroups($cookie, $message, $link, $limit, $without_approval);

            echo json_encode($result);

            break;
    }
}