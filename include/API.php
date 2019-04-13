<?php
include_once "FBData.php";
include_once "CURL.php";
include_once "Proxy.php";
include_once "Connection.php";
include_once "Logger.php";
include_once "ProxyManager.php";

class API
{

    /**
     * API constructor.
     */
    public function __construct()
    {
    }

    public function GetFBData(string $cookie, Proxy $proxy)
    {
        try {
            $curl = new CURL("https://m.facebook.com/");
            $curl->setCookie($cookie);
            $curl->setProxy($proxy);
            $response = $curl->send();
            $curl->close();

            $data = $response->data;

            preg_match('#name="fb_dtsg" value="(.+?)"#is', $data, $fb_dtsg);
            preg_match('#c_user=(\d+);#is', $cookie, $user_id);


            if (isset($fb_dtsg[1]) && isset($user_id[1])) {
                $FBData = new FBData();
                $FBData->fb_dtsg = $fb_dtsg[1];
                $FBData->user_id = $user_id[1];
                $FBData->cookie = $cookie;
                return $FBData;
            } else {
                throw new Exception("Can not read FBData");
            }
        } catch (Exception $e) {
            die($e->getMessage());
        }

    }

    private function Setting(string $cookie, Proxy $proxy)
    {
        $curl = new CURL('https://m.facebook.com/settings/account/');
        $curl->setCookie($cookie);
        $curl->setProxy($proxy);
        $curl->setConnectTimeOut(5);
        $curl->send();
        $curl->close();
    }

    private function Dialog(FBData $FBData, Proxy $proxy)
    {
        $url = "https://www.facebook.com/dialog/oauth?scope=user_about_me,user_actions.books,user_actions.fitness,publish_actions,user_actions.music,user_actions.news,user_actions.video,user_activities,user_birthday,user_education_history,user_events,user_friends,user_games_activity,user_groups,user_hometown,user_interests,user_likes,user_location,user_managed_groups,user_photos,user_posts,user_relationship_details,user_relationships,user_religion_politics,user_status,user_tagged_places,user_videos,user_website,user_work_history,email,manage_notifications,manage_pages,publish_actions,publish_pages,read_friendlists,read_insights,read_page_mailboxes,read_stream,rsvp_event,read_mailbox&response_type=token&client_id=124024574287414&redirect_uri=fb124024574287414://authorize/&sso_key=com&display=popup";

        $curl = new CURL($url);
        $curl->setCookie($FBData->cookie);
        $curl->setProxy($proxy);
        $response = $curl->send();
        $curl->close();

        $data = $response->data;

        preg_match('#name="read" value="(.+?)"#is', $data, $read);
        preg_match('#name="write" value="(.+?)"#is', $data, $write);
        preg_match('#name="extended" value="(.+?)"#is', $data, $extended);
        preg_match('#name="seen_scopes" value="(.+?)"#is', $data, $seen_scopes);

        if (isset($read[1]) && isset($write[1]) && isset($extended[1]) && isset($seen_scopes[1])) {
            $FBData->read = $read[1];
            $FBData->write = $write[1];
            $FBData->extended = $extended[1];
            $FBData->seen_scopes = $seen_scopes[1];
            return $FBData;
        } else return false;

    }

    private function ReadToken(FBData $FBData, Proxy $proxy)
    {
        $curl = new CURL('https://www.facebook.com/v1.0/dialog/oauth/read?dpr=1&__pc=');
        $curl->setCookie($FBData->cookie);
        $curl->setProxy($proxy);
        $curl->setConnectTimeOut(5);
        $post_Data = [
            'fb_dtsg' => $FBData->fb_dtsg,
            'app_id' => FB_APP_ID,
            'redirect_uri' => 'fb' . FB_APP_ID . '://authorize/',
            'display' => 'popup',
            'from_post' => '1',
            'public_info_nux' => 'true',
            'read' => $FBData->read,
            'write' => $FBData->write,
            'extended' => $FBData->extended,
            'seen_scopes' => $FBData->seen_scopes,
            'ref' => 'Default',
            'return_format' => 'access_token',
            'sso_device' => 'ios',
            'sheet_name' => 'initial',
            '__CONFIRM__' => '1',
            '__user' => $FBData->user_id,
            '__a' => '1',
        ];
        $curl->post($post_Data);
        $response = $curl->send();
        $curl->close();

        return $response->data;
    }

    private function WriteToken(FBData $FBData, Proxy $proxy)
    {
        $curl = new CURL('https://www.facebook.com/v1.0/dialog/oauth/write?dpr=1&__pc=');
        $curl->setCookie($FBData->cookie);
        $curl->setProxy($proxy);
        $curl->setConnectTimeOut(5);
        $post_Data = [
            'fb_dtsg' => $FBData->fb_dtsg,
            'app_id' => FB_APP_ID,
            'redirect_uri' => 'fb' . FB_APP_ID . '://authorize/',
            'display' => 'popup',
            'from_post' => '1',
            'audience[0][value]' => '80',
            'write' => $FBData->write,
            'extended' => $FBData->extended,
            'seen_scopes' => $FBData->seen_scopes,
            'ref' => 'Default',
            'return_format' => 'access_token',
            'sso_device' => 'ios',
            'sheet_name' => 'initial',
            '__CONFIRM__' => '1',
            '__user' => $FBData->user_id,
            '__a' => '1',
        ];
        $curl->post($post_Data);
        $response = $curl->send();
        $curl->close();

        return $response->data;
    }

    private function ExtendedToken(FBData $FBData, Proxy $proxy)
    {
        $curl = new CURL('https://www.facebook.com/v1.0/dialog/oauth/extended?dpr=1&__pc=');
        $curl->setCookie($FBData->cookie);
        $curl->setProxy($proxy);
        $curl->setConnectTimeOut(5);
        $post_Data = [
            'fb_dtsg' => $FBData->fb_dtsg,
            'app_id' => FB_APP_ID,
            'redirect_uri' => 'fb' . FB_APP_ID . '://authorize/',
            'display' => 'popup',
            'from_post' => '1',
            'extended' => $FBData->extended,
            'seen_scopes' => $FBData->seen_scopes,
            'ref' => 'Default',
            'return_format' => 'access_token',
            'sso_device' => 'ios',
            'sheet_name' => 'initial',
            '__CONFIRM__' => '1',
            '__user' => $FBData->user_id,
            '__a' => '1',
        ];
        $curl->post($post_Data);
        $response = $curl->send();
        $curl->close();

        return $response->data;
    }

    private function ConfirmToken(FBData $FBData, Proxy $proxy)
    {
        try {
            $curl = new CURL('https://m.facebook.com/v1.0/dialog/oauth/confirm');
            $curl->setCookie($FBData->cookie);
            $curl->setProxy($proxy);
            $curl->setConnectTimeOut(5);
            $post_Data = [
                'fb_dtsg' => $FBData->fb_dtsg,
                'app_id' => FB_APP_ID,
                'redirect_uri' => 'fbconnect://success',
                'display' => 'page',
                'from_post' => '1',
                'ref' => 'Default',
                'return_format' => 'access_token',
                'sso_device' => 'ios',
                'sheet_name' => 'initial',
                '__CONFIRM__' => '1',
                '__user' => $FBData->user_id,
                '__a' => '1',
            ];
            $curl->post($post_Data);
            $response = $curl->send();
            $curl->close();
            $data = $response->data;

            preg_match('#access_token=(.+?)&data_access_expiration_time#is', $data, $token);
            preg_match('#expires_in=(\d+)"#is', $data, $expires);
            if (isset($token[1])) {
                $FBData->expiration_time = $expires[1];
                return $token[1];
            } else throw new Exception("Can not read token");
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function GetProxy_HTTP(string $proxytype, int $timeout, string $country, string $ssl, string $anonymity)
    {
        $result = array();
        $url = 'https://proxyscrape.com/api?request=getproxies&proxytype=' . $proxytype . '&timeout=' . $timeout . '&country=' . $country . '&ssl=' . $ssl . '&anonymity=' . $anonymity;
        $curl = new CURL($url);
        $response = $curl->send();
        $curl->close();
        $data = $response->data;

        $proxys = explode(PHP_EOL, $data);

        foreach ($proxys as $proxy) {
            $result[] = new Proxy($proxy);
        }

        return $result;
    }

    public function GetIp(Proxy $proxy, int $time_out = 20)
    {
        $curl = new CURL("https://api.ipify.org?format=json");
        $response = $curl->send();
        $curl->close();
        $data = json_decode($response->data);
        return $data->ip;
    }

    private function FindValue(string $html, string $input_name)
    {
        $document = new DOMDocument();
        $document->loadHTML($html);
        $inputs = $document->getElementsByTagName("input");
        foreach ($inputs as $key => $input) {
            if ($input->getAttribute("name") == $input_name) {
                $value = $input->getAttribute("value");
                break;
            }
        }
        return $value;
    }

    function GetObj()
    {
        $data = [
            '0' => '461844327276648',
            '1' => '1612829125684071',
            '2' => '198483360302297',
            '3' => '165039663531531',
            '4' => '299823080101946',
            '5' => '97460504492',
            '6' => '177057152404760',
            '7' => '244944385603396',
            '8' => '667771320068477',
            '9' => '412842818820007',
            '10' => '101277363291907',
            '11' => '141793582653695',
            '12' => '82061850555',
            '13' => '129079313911235',
            '14' => '138959836987057',
            '15' => '429652537560960',
            '16' => '141859655917743',
            '17' => '526840431027583',
            '18' => '56531631380',
            '19' => '343669132319719',
            '20' => '641176452898203',
            '21' => '156202471146560',
            '22' => '1456861314574719',
            '23' => '1629716087294615',
            '24' => '447775968580065'

        ];
        return $data[rand(0, count($data) - 1)];
    }


    public function getTokenWithCookie(string $cookie)
    {
        $proxyM = new ProxyManager();
        $proxys = $proxyM->getProxys();

        $proxy = $proxys[random_int(0, count($proxys) - 1)];

        $FBData = $this->GetFBData($cookie, $proxy);

//        $this->Setting($FBData->cookie, $proxy);
//            $data = $this->Dialog($FBData, $proxy);
//            if ($data){
//                $this->ReadToken($FBData, $proxy);
//                $this->WriteToken($FBData, $proxy);
//                $this->ExtendedToken($FBData, $proxy);
//                $FBData->token = $this->ConfirmToken($FBData, $proxy);
//            } else {
//                $FBData->token = false;
//            };

        $FBData->token = $this->ConfirmToken($FBData, $proxy);

        $conn = getConnection();

        $res = $conn->query("SELECT uid FROM fb_account WHERE uid = $FBData->user_id");

        if ($res->num_rows == 0) {
            $sql = "INSERT INTO fb_account (uid, fb_dtsg, cookie, token, expiration_time) VALUES ('$FBData->user_id', '$FBData->fb_dtsg', '$FBData->cookie', '$FBData->token', DATE_ADD(CURRENT_TIMESTAMP, INTERVAL $FBData->expiration_time SECOND));";
        } else {
            $sql = "UPDATE fb_account SET cookie = '$FBData->cookie', fb_dtsg = '$FBData->fb_dtsg', token = '$FBData->token', get_time = CURRENT_TIMESTAMP, expiration_time = DATE_ADD(CURRENT_TIMESTAMP, INTERVAL $FBData->expiration_time SECOND) WHERE  uid = '$FBData->user_id'";
        }

        $conn->query($sql);

        $conn->close();

        return $FBData;
    }

    public function getToken(string $cookie, Proxy $proxy)
    {

        $FBData = $this->GetFBData($cookie, $proxy);

//        $this->Setting($FBData->cookie, $proxy);
//        $this->Dialog($FBData, $proxy);
//        $this->ReadToken($FBData, $proxy);
//        $this->WriteToken($FBData, $proxy);
//        $this->ExtendedToken($FBData, $proxy);
        $FBData->token = $this->ConfirmToken($FBData, $proxy);

        $conn = getConnection();

        $res = $conn->query("SELECT uid FROM fb_account WHERE uid = $FBData->user_id");

        if ($res->num_rows == 0) {
            $sql = "INSERT INTO fb_account (uid, fb_dtsg, cookie, token, expiration_time) VALUES ('$FBData->user_id', '$FBData->fb_dtsg', '$FBData->cookie', '$FBData->token', DATE_ADD(CURRENT_TIMESTAMP, INTERVAL $FBData->expiration_time SECOND));";
        } else {
            $sql = "UPDATE fb_account SET cookie = '$FBData->cookie', fb_dtsg = '$FBData->fb_dtsg', token = '$FBData->token', get_time = CURRENT_TIMESTAMP, expiration_time = DATE_ADD(CURRENT_TIMESTAMP, INTERVAL $FBData->expiration_time SECOND)";
        }

        $conn->query($sql);

        $conn->close();

        return $FBData;
    }

    public function shareOnGroup(FBData $FBData, string $group_id, string $message, string $link, Proxy $proxy)
    {
        try {
            $curl = new Curl('https://m.facebook.com/a/group/post/add/?gid=' . $group_id);
            $curl->setCookie($FBData->cookie);
            $curl->setProxy($proxy);
            $curl->setConnectTimeOut(5);
            $postData = [
                'rating' => '0',
                'message' => $message,
                // 'attachment[params][0]' => '2168132523497904',
                // 'attachment[type]' => '11',
                'group_id' => $group_id,
                'linkUrl' => $link,
                'ogaction' => '520095228026772',
                'ogobj' => $this->GetObj(),
                'fb_dtsg' => $FBData->fb_dtsg,
            ];
            $curl->post($postData);
            $res = $curl->send();
            if ($res->data == ""){
                throw new Exception("Can not share to group id $group_id");
            }
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function getListGroups(FBData $FBData, Proxy $proxy)
    {
        $curl = new Curl('https://z-m-graph.fb.me/graphql?q=me(){groups{nodes{group_members{count},id,name,viewer_post_status,visibility}}}&access_token=' . $FBData->token);
        $curl->setProxy($proxy);
        $response = $curl->send();
        $data = $response->data;
        $data = json_decode($data, true);
        return $data["$FBData->user_id"]["groups"]["nodes"];
    }

    public function shareOnMultipleGroups(string $cookie, string $message, string $link, $limit, bool $without_approval){
        $logger = new Logger("log.log");
        $proxyM = new ProxyManager();

        $proxys = $proxyM->getProxys();

        $proxy = $proxys[random_int(0, count($proxys) - 1)];

        $FBData = $this->getToken($cookie, $proxy);

        $list_groups = $this->getListGroups($FBData, $proxy);

        $result = [];
        $count = 0;

        foreach ($list_groups as $group) {
            if ($without_approval && $group['viewer_post_status'] != "CAN_POST_WITHOUT_APPROVAL") continue;

            $this->shareOnGroup($FBData, $group['id'], $message, $link, $proxy);

            $count++;
            $logger->log($FBData->user_id . " => (" . $count . ") " . $group['id']);
            $result[] = $group;

            if ($limit != NULL && $count >= $limit) break;
        }

        return $result;
    }

}