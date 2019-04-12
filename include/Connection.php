<?php

function getConnection(){
    return new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
}