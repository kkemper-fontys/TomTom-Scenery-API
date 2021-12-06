<?php

include_once("./responsecode.php");
include_once("./key-authenticator.php");

$URL_DATA = $_SERVER['REQUEST_URI'];
$URL = explode("/", substr($URL_DATA, 1));

// GET DATA FROM URL
$KEY =              $URL[0];
$API_TYPE =         $URL[1];

// SEND API CALL TO DATABASE
include_once("../api/create.php");

//CHECK IF KEY EXISTS
if (!authorization::checkKey($key)) {
    responseCode::sendCode(401);
} else {
    if ($API_TYPE === 'search') {
        $SEARCH_TYPE = $URL[2];

        if ($SEARCH_TYPE === 'categories') {
            include("../categories/read.php");
        } elseif ($SEARCH_TYPE === 'subcategories') {
            include("../categories/read.php");
        } else {
            responseCode::sendCode(401);
        }
    }
    if($API_TYPE === 'create'){
        include("../user/create.php");
    }
    if($API_TYPE === 'getUserById'){
        include("../user/read.php");
    }
    if($API_TYPE === 'update'){
        include("../position/create.php");
        include("../user/update.php");
    }
    if($API_TYPE === 'updateUserCategory'){
        include("../userCategories/update.php");
    }
    if($API_TYPE === 'poi'){
        include("../poi/read.php");
    }
}
