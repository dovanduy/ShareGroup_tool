<?php
/**
 * Created by PhpStorm.
 * User: Ryan
 * Date: 17/04/2019
 * Time: 1:19 CH
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

$html = file_get_html('https://fb.com');
echo $html;