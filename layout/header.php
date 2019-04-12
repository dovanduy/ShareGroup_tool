<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="<?php echo PATH; ?>/public/images/favicon.ico">
    <link rel="stylesheet" href="<?php echo PATH; ?>/public/lib/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="<?php echo PATH; ?>/public/lib/mdb/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo PATH; ?>/public/lib/mdb/css/mdb.min.css">
    <link rel="stylesheet" href="<?php echo PATH; ?>/public/css/style.css">
    <script>const PATH = "<?php echo PATH; ?>"; </script>
    <title><?php if (isset($_SESSION['title'])){echo $_SESSION["title"];} ?></title>
</head>
<body>

