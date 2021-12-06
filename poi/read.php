<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/database.php';
include_once '../objects/poi.php';

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// initialize object
$poi = new Poi($db);

// read products will be here
// query products
$URL_DATA = $_SERVER['REQUEST_URI'];
$URL = explode("/", substr($URL_DATA, 1));
$DEVICE_ID = $URL[2];
$timestamp = $URL[3];

$stmt = $poi->read($DEVICE_ID, $timestamp);

$num = $stmt->rowCount();

// check if more than 0 record found
if ($num > 0) {

    // products array
    $poi_array = array();

    // retrieve our table contents
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // extract row
        extract($row);

            $poi_item = array(
                "id" => $id,
                "user_id" => $user_id,
                "name" => $name,
                "address" => $address,
                "longitude" => $longitude,
                "latitude" => $latitude,
                "category_id" => $category_id,
                "timestamp" => $timestamp
            );

        array_push($poi_array, $poi_item);
    }

    // set response code - 200 OK
    http_response_code(200);

    // show poi data in json format
    echo json_encode($poi_array);
} else {
    // set response code - 404 Not found
    http_response_code(404);

    // tell the user no poi found
    echo json_encode(
        array("message" => "No Points of Interest found.")
    );
}
  
// no poi's found will be here