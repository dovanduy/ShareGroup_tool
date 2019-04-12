<?php
/**
 * Created by PhpStorm.
 * User: Ryan
 * Date: 11/04/2019
 * Time: 4:46 CH
 */

if (!isset($_SESSION)){
    session_start();
}
session_destroy();
unset($_SESSION['username']);
unset($_SESSION['password']);
unset($_SESSION['auth']);
header('location: index.php');