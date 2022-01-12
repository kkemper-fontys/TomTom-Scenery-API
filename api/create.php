<?php
// USAGE:
// every API_CALL to api.keeskemper.nl is logged in the database

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/database.php';
include_once '../objects/api.php';

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// initialize object
$api = new Api($db);

// read deviceinfo will be here
// query deviceinfo
$URL_DATA = $_SERVER['REQUEST_URI'];

// get time of API Call
$time = time();

// check if call already excists in database
$stmt2 = $api->read($URL_DATA, $time);
$num = $stmt2->rowCount();

// if no record is found, store the API-call in the database
if ($num == 0) {
    $stmt = $api->create($URL_DATA, $time);
}
