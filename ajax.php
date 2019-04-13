<?php
include_once "include/API.php";
include_once "include/Logger.php";

set_time_limit(120);

$api = new API();
$logger = new Logger("log.log");

if (isset($_POST['request'])) {

    switch ($_POST['request']) {

        case "get_token":

            $result = array('uid'=>'', 'token'=>'');

            $FBData = $api->getTokenWithCookie($_POST['cookie']);

            $result['uid'] = $FBData->user_id;
            $result['token'] = $FBData->token;

            $result = json_encode($result);

            echo $result;

            break;

        case "share_group":

            $result = $api->shareOnMultipleGroups($_POST['cookie'], $_POST['message'], $_POST['link'], intval($_POST['limit']));

            echo json_encode($result);

            break;
    }
}