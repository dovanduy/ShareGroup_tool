<?php
include "config.php";
include "include/CURL.php";
include "include/Proxy.php";
include "include/Logger.php";
include "include/API.php";

$API = new API();
if (isset($_POST['request'])) {

    $logger = new Logger("log.log");

    switch ($_POST['request']) {
        case "get_token":

            $cookie = $_POST['cookie'];
            $result = array('proxy'=>'','ip'=>'', 'token'=>'');

            $result['proxy'] = $proxy = new Proxy("138.59.206.68:9620:WsfgRQ:Lu9N3f");
            $result['ip'] = $API->GetIp($proxy);
            $FBData = $API->getTokenWithCookie($cookie, $proxy);
            $result['token'] = $FBData->token;

            $result = json_encode($result);
            $logger->log($result);

            echo $result;

            break;

        case "share_group":

            $cookie = $_POST['cookie'];
            $mess = $_POST['cookie'];
            $cookie = $_POST['cookie'];
            $cookie = $_POST['cookie'];
            $result = array('proxy'=>'','ip'=>'', 'token'=>'');

            $result['proxy'] = $proxy = new Proxy("138.59.206.68:9620:WsfgRQ:Lu9N3f");
            $result['ip'] = $API->GetIp($proxy);
            $result['token'] = $API->getTokenWithCookie($cookie, $proxy);

            $result = json_encode($result);
            $logger->log($result);

            echo $result;

            break;
    }
}
