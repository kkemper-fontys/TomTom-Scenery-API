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
    // key not found, send 401 error code back
    responseCode::sendCode(401);
} else {
    // key found, check API type and include the right page
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
    // create new user
    if($API_TYPE === 'create'){
        include("../user/create.php");
    }

    // get data of all users
    if($API_TYPE === 'users'){
        $SEARCH_TYPE = $URL[2];
        if($SEARCH_TYPE === 'readall'){
            include("../user/readAll.php");
        }
    }

    // get user data by id
    if($API_TYPE === 'getUserById'){
        include("../user/read.php");
    }

    // update user data
    if($API_TYPE === 'update'){
        include("../position/create.php");
        include("../user/update.php");
    }

    // update users favorite categories
    if($API_TYPE === 'updateUserCategory'){
        include("../userCategories/update.php");
    }

    // get users favorite categories
    if($API_TYPE === 'readUserCategories'){
        include("../userCategories/read.php");
    }

    // get and set points of interest
    if($API_TYPE === 'poi'){
        $POI_TYPE = $URL[2];
        if($POI_TYPE === 'read'){
            include("../poi/read.php");
        } elseif($POI_TYPE === 'create'){
            include("../poi/create.php");
        }
    }
}
