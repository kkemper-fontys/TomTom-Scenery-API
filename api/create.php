<?php
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

// check if more than 0 record found
if ($num == 0) {
    $stmt = $api->create($URL_DATA, $time);
}
