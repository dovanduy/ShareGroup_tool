<?php

function getConnection(){
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME) or die("Cannot connect Database");
    return $conn;
}

