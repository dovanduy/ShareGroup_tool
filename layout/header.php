<?php
function get_browser_name($user_agent)
{
    if (strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR/')) return 'Opera';
    elseif (strpos($user_agent, 'Edge')) return 'Edge';
    elseif (strpos($user_agent, 'Chrome')) return 'Chrome';
    elseif (strpos($user_agent, 'Safari')) return 'Safari';
    elseif (strpos($user_agent, 'Firefox')) return 'Firefox';
    elseif (strpos($user_agent, 'MSIE') || strpos($user_agent, 'Trident/7')) return 'Internet Explorer';

    return 'Other';
}


$browser = get_browser_name($_SERVER['HTTP_USER_AGENT']);

if ($browser == 'Internet Explorer') die(
"<h3>Trình duyêt này không được hỗ trợ. Bạn vui lòng sử dụng Chrome hoặc Firefox</h3>"
);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php if (isset($_SESSION['title'])) {
            echo $_SESSION["title"];
        } ?></title>
    <link rel="icon" href="<?php echo PATH; ?>/public/images/favicon.ico">
    <link rel="stylesheet" href="<?php echo PATH; ?>/public/lib/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="<?php echo PATH; ?>/public/lib/mdb/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo PATH; ?>/public/lib/mdb/css/mdb.min.css">
    <link rel="stylesheet" href="<?php echo PATH; ?>/public/css/style.css">
    <script>const PATH = "<?php echo PATH; ?>"; </script>
</head>
<body>

