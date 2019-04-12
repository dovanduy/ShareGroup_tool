<?php
include "FBData.php";

class API{

    /**
     * API constructor.
     */
    public function __construct()
    {
    }

    public function GetFBData(string $cookie, Proxy $proxy){
        $curl = new CURL("https://m.facebook.com/");
        $curl->setCookie($cookie);
        $curl->setProxy($proxy);
        $response = $curl->send();
        $curl->close();

        $data = $response->data;

        preg_match('#name="fb_dtsg" value="(.+?)"#is',$data, $fb_dtsg);
        preg_match('#name="target" value="(.+?)"#is',$data, $user_id);

        if ( isset($fb_dtsg[1]) && isset($user_id[1]) ){
            $FBData = new FBData();
            $FBData->fb_dtsg = $fb_dtsg[1];
            $FBData->user_id = $user_id[1];
            $FBData->cookie = $cookie;
            return $FBData;
        } else return false;

    }

    private function Setting(string $cookie, Proxy $proxy){
        $curl = new CURL('https://m.facebook.com/settings/account/');
        $curl->setCookie($cookie);
        $curl->setProxy($proxy);
        $curl->setConnectTimeOut(5);
        $curl->send();
        $curl->close();
    }

    private function Dialog(FBData $FBData, Proxy $proxy){
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

        if ( isset($read[1]) && isset($write[1]) && isset($extended[1]) && isset($seen_scopes[1]) ){
            $FBData->read = $read[1];
            $FBData->write = $write[1];
            $FBData->extended = $extended[1];
            $FBData->seen_scopes = $seen_scopes[1];
            return $FBData;
        }else return false;


    }

    private function ReadToken(FBData $FBData, Proxy $proxy){
        $curl = new CURL('https://www.facebook.com/v1.0/dialog/oauth/read?dpr=1&__pc=');
        $curl->setCookie($FBData->cookie);
        $curl->setProxy($proxy);
        $curl->setConnectTimeOut(5);
        $post_Data = [
            'fb_dtsg' => $FBData->fb_dtsg,
            'app_id' => FB_APP_ID,
            'redirect_uri' => 'fb'.FB_APP_ID.'://authorize/',
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

    private function WriteToken(FBData $FBData, Proxy $proxy){
        $curl = new CURL('https://www.facebook.com/v1.0/dialog/oauth/write?dpr=1&__pc=');
        $curl->setCookie($FBData->cookie);
        $curl->setProxy($proxy);
        $curl->setConnectTimeOut(5);
        $post_Data = [
            'fb_dtsg' => $FBData->fb_dtsg,
            'app_id' => FB_APP_ID,
            'redirect_uri' => 'fb'.FB_APP_ID.'://authorize/',
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

    private function ExtendedToken(FBData $FBData, Proxy $proxy){
        $curl = new CURL('https://www.facebook.com/v1.0/dialog/oauth/extended?dpr=1&__pc=');
        $curl->setCookie($FBData->cookie);
        $curl->setProxy($proxy);
        $curl->setConnectTimeOut(5);
        $post_Data = [
            'fb_dtsg' => $FBData->fb_dtsg,
            'app_id' => FB_APP_ID,
            'redirect_uri' => 'fb'.FB_APP_ID.'://authorize/',
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

    private function ConfirmToken(FBData $FBData, Proxy $proxy){
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

        preg_match('#access_token=(.+?)&data_access_expiration_time#is',$data, $token);
        if (isset($token[1])){
            $result = $token[1];
            return $result;
        }else return false;
    }

    public function GetProxy_HTTP(string $proxytype, int $timeout, string $country, string $ssl, string $anonymity){
        $result = array();
        $url = 'https://proxyscrape.com/api?request=getproxies&proxytype='.$proxytype.'&timeout='.$timeout.'&country='.$country.'&ssl='.$ssl.'&anonymity='. $anonymity;
        $curl = new CURL($url);
        $response = $curl->send();
        $curl->close();
        $data = $response->data;

        $proxys = explode(PHP_EOL, $data);

        foreach ($proxys as $proxy){
            $result[] = new Proxy($proxy);
        }

        return $result;
    }

    public function GetIp(Proxy $proxy, int $time_out = 20){
        $curl = new CURL("https://api.ipify.org?format=json");
        $response = $curl->send();
        $curl->close();
        $data = json_decode($response->data);
        return $data->ip;
    }

    private function FindValue(string $html, string $input_name){
        $document = new DOMDocument();
        $i = $document->createElement("input");
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

    function GetObj(){
        $data = [
            '0'	=>	'461844327276648',
            '1'	=>	'1612829125684071',
            '2'	=>	'198483360302297',
            '3'	=>	'165039663531531',
            '4'	=>	'299823080101946',
            '5'	=>	'97460504492',
            '6'	=>	'177057152404760',
            '7'	=>	'244944385603396',
            '8'	=>	'667771320068477',
            '9'	=>	'412842818820007',
            '10'	=>	'101277363291907',
            '11'	=>	'141793582653695',
            '12'	=>	'82061850555',
            '13'	=>	'129079313911235',
            '14'	=>	'138959836987057',
            '15'	=>	'429652537560960',
            '16'	=>	'141859655917743',
            '17'	=>	'526840431027583',
            '18'	=>	'56531631380',
            '19'	=>	'343669132319719',
            '20'	=>	'641176452898203',
            '21'	=>	'156202471146560',
            '22'	=>	'1456861314574719',
            '23'	=>	'1629716087294615',
            '24'	=>	'447775968580065'

        ];
        return $data[rand(0, count($data)-1)];
    }


    public function getTokenWithCookie(string $cookie, Proxy $proxy){
        $FBData = $this->GetFBData($cookie, $proxy);

        if ($FBData) {
            $this->Setting($FBData->cookie, $proxy);
            $data = $this->Dialog($FBData, $proxy);
            if ($data){
                $this->ReadToken($FBData, $proxy);
                $this->WriteToken($FBData, $proxy);
                $this->ExtendedToken($FBData, $proxy);
                $FBData->token = $this->ConfirmToken($FBData, $proxy);
                return $FBData;
            } else return "Can not get FBScope";
        } else return "Can not get FBData";
    }

    public function getFriends(string $token, Proxy $proxy){
        $curl = new CURL('https://graph.facebook.com/me?fields=friends.limit(5000)&access_token='.$token);
        $curl->setProxy($proxy);
        $response = $curl->send();
        $curl->setProxy($proxy);
        $curl->close();

        $data = $response->data;

        return $data;
    }

    public function postToGroup(FBData $FBData, string $group_id, string $message, string $link, string $html, Proxy $proxy){
        $url = 'https://m.facebook.com/a/group/post/add/?gid='. $group_id;
        $curl = new CURL($url);
        $curl->setCookie($FBData->cookie);
        $curl->setProxy($proxy);
        $curl->setConnectTimeOut(5);
        $postData = [
            'message' => $message,
            'attachment[params][urlInfo][canonical]' => $this->FindValue($html, 'attachment[params][urlInfo][canonical]'),
            'attachment[params][urlInfo][final]' => $this->FindValue($html, 'attachment[params][urlInfo][final]'),
            'attachment[params][urlInfo][user]' => $this->FindValue($html, 'attachment[params][urlInfo][user]'),
            'attachment[params][favicon]' => $this->FindValue($html, 'attachment[params][favicon]'),
            'attachment[params][external_author]' => $this->FindValue($html, 'attachment[params][external_author]'),
            'attachment[params][title]' => $this->FindValue($html, 'attachment[params][title]'),
            'attachment[params][summary]' => $this->FindValue($html, 'attachment[params][summary]'),
            'attachment[params][ranked_images][images][0]' => $this->FindValue($html, 'attachment[params][ranked_images][images][0]'),
            'attachment[params][ranked_images][ranking_model_version]' => $this->FindValue($html, 'attachment[params][ranked_images][ranking_model_version]'),
            'attachment[params][ranked_images][specified_og]' => $this->FindValue($html, 'attachment[params][ranked_images][specified_og]'),
            'attachment[params][medium]' => $this->FindValue($html, 'attachment[params][medium]'),
            'attachment[params][url]' => $this->FindValue($html, 'attachment[params][url]'),
            'attachment[params][global_share_id]' => $this->FindValue($html, 'attachment[params][global_share_id]'),
            'attachment[params][amp_url]' => $this->FindValue($html, 'attachment[params][amp_url]'),
            'attachment[params][url_scrape_id]' => $this->FindValue($html, 'attachment[params][url_scrape_id]'),
            'attachment[params][hmac]' => $this->FindValue($html, 'attachment[params][hmac]'),
            'attachment[params][locale]' => $this->FindValue($html, 'attachment[params][locale]'),
            'attachment[params][external_img]' => $this->FindValue($html, 'attachment[params][external_img]'),
            'attachment[type]' => $this->FindValue($html, 'attachment[type]'),
            'group_id' => $group_id,
            'linkUrl' => $link,
            '__a' => 1,
            'fb_dtsg' => $FBData->fb_dtsg,
        ];

        $curl->post($postData);
        $response = $curl->send();
        $data = $response->data;
        $data = substr($data, 9);
        $data = json_decode($data, true);
        preg_match('#id=([0-9]+)#is',$data['payload']['actions'][1]['html'], $result);
        return $result[1];
    }

    public function getLinkFacebook(array $Handle, string $url, Proxy $proxy){
        $curl = new Curl('https://m.facebook.com/share_preview/?surl='. $url);
        $curl->setProxy($proxy);
        $curl->setConnectTimeOut(5);
        $curl->setCookie($Handle['cookie']);
        $postData = [
            '__user' => $Handle['user_id'],
            'fb_dtsg' => $Handle['fb_dtsg']
        ];
        $curl->post($postData);
        $response = $curl->send();
        $data = $response->data;
        $data = substr($data, 9);
        $data = json_decode($data, true);
        return $data['payload']['actions'][0]['html'];
    }


    public function createGroup(FBData $FBData, string $group_name, array $info_friend, Proxy $proxy){
        $curl = new CURL('https://www.facebook.com/ajax/groups/create_post/');
        $curl->setProxy($proxy);
        $curl->setCookie($FBData->cookie);
        $curl->setConnectTimeOut(5);
        $postData = [
            'fb_dtsg' => $FBData->fb_dtsg,
            'name' => $group_name,
            'members[0]' => $info_friend['id'],
            'text_members[0]' => $info_friend['name'],
            '__a' => 1,
            'privacy' => 'open'
        ];
        $curl->post($postData);
        $response = $curl->send();
        $data = $response->data;
        $data = substr($data, 9);
        $data = json_decode($data, true);
        preg_match('#/groups/([0-9]+)/#is',$data['jsmods']['require'][0][3][0], $result);
        return $result[1];
    }

    public function shareOnGroup(FBData $FBData, string $group_id, string $message, string $link, Proxy $proxy){
        $curl = new Curl('https://m.facebook.com/a/group/post/add/?gid='.$group_id);
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
        $response = $curl->send();
        return $response;
    }

    public function getListGroups(FBData $FBData, Proxy $proxy){
        $curl = new Curl('https://graph.fb.me/graphql?q=me(){groups{nodes{group_members{count},id,name,viewer_post_status,visibility}}}&access_token='.$FBData->token);
        $curl->setProxy($proxy);
        $response = $curl->send();
        $data = $response->data;
        $data = json_decode($data, true);
        return $data[$FBData->user_id]['groups']['nodes'];
    }

    public function shareOnMultipleGroups(string $cookie, string $message, string $link, Proxy $proxy){
        $FBData = $this->getTokenWithCookie($cookie, $proxy);
        $list_groups = $this->getListGroups($FBData->token, $proxy);
        foreach ($list_groups as $group){
            $this->shareOnGroup($FBData, $group['id'], $message, $link, $proxy);
        }
    }
}