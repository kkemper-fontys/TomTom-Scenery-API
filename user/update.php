<?php
// USAGE:
// https://api.keeskemper.nl/<key>/update/user/<device_id>/<longitude>,<latitude>

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/database.php';
include_once '../objects/user.php';

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// initialize object
$user = new User($db);

// read user will be here
// query users
$URL_DATA = $_SERVER['REQUEST_URI'];
$URL = explode("/", substr($URL_DATA, 1));
$DEVICE_ID = $URL[3];

$coords = explode(",", $URL[4]);
$longitude = $coords[0];
$latitude = $coords[1];


$stmt = $user->updateByDeviceId($DEVICE_ID, $longitude, $latitude);

$num = $stmt->rowCount();

// check if more than 0 record found
if ($num > 0) {

    // set response code - 200 OK
    http_response_code(200);

    // show user data in json format
    echo json_encode(
        array("message" => "User changed.")
    );
} else {
    // set response code - 404 Not found
    http_response_code(404);

    // tell the user no users found
    echo json_encode(
        array("message" => "No user found.")
    );
}
  
// no user found will be here