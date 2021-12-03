<?php
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

// read products will be here
// query products
$URL_DATA = $_SERVER['REQUEST_URI'];
$URL = explode("/", substr($URL_DATA, 1));
$DEVICE_ID = $URL[2];

$stmt = $user->readByDeviceId($DEVICE_ID);

$num = $stmt->rowCount();

// check if more than 0 record found
if ($num > 0) {

    // set response code - 200 OK
    http_response_code(200);

    // show products data in json format
    echo json_encode(
        array("message" => "User found.")
    );
} else {
    // set response code - 404 Not found
    http_response_code(404);

    // tell the user no products found
    echo json_encode(
        array("message" => "No user found.")
    );
}
  
// no products found will be here