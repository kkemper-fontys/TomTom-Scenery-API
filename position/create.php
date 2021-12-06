<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/database.php';
include_once '../objects/position.php';

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// initialize object
$position = new Position($db);

// read products will be here
// query products
$URL_DATA = $_SERVER['REQUEST_URI'];
$URL = explode("/", substr($URL_DATA, 1));
$DEVICE_ID = $URL[3];

$coords = explode(",", $URL[4]);
$longitude = $coords[0];
$latitude = $coords[1];

$time = time();

// check if position already excists in database
$stmt2 = $position->read($longitude, $latitude, $time);
$num = $stmt2->rowCount();

if($num == 0){
    $stmt = $position->create($longitude, $latitude, $time);
}

$num = $stmt->rowCount();