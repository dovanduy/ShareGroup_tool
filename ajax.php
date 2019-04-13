<?php
include_once "include/API.php";
include_once "include/Logger.php";
include_once "include/ProxyManager.php";

set_time_limit(120);

$api = new API();
$logger = new Logger("log.log");
$proxyM = new ProxyManager();

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

            $proxys = $proxyM->getProxys();

            $proxy = $proxys[random_int(0, count($proxys) - 1)];

            $FBData = $api->getToken($cookie, $proxy);

            $list_groups = $api->getListGroups($FBData, $proxy);

            $count = 0;

//            foreach ($list_groups as $group) {
//                if ($without_approval && $group['viewer_post_status'] != "CAN_POST_WITHOUT_APPROVAL") continue;
//
//                $res = $this->shareOnGroup($FBData, $group['id'], $message, $link, $proxy);
//
//                if ($res) {
//                    $count++;
//                    $logger->log($FBData->user_id . " => (" . $count . ") " . $group['id']);
//                    echo json_encode($group);
//                }
//
//                if ($limit != NULL && $count >= $limit) break;
//            }

        var_dump($list_groups);

            break;
    }
}