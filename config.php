<?php

preg_match("/^\/(.*)\/.*.*\.php$/", $_SERVER['PHP_SELF'], $matches);
isset($matches[1]) ?  $folder = $matches[1] : $folder = "";

define("FOLDER", $folder);
define("PATH", "http://".$_SERVER['SERVER_NAME'].":".$_SERVER['SERVER_PORT']."/".$folder);
define("FB_APP_ID", "124024574287414");

define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "fb_tool");


date_default_timezone_set("Asia/Ho_Chi_Minh");

?>