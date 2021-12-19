<?php
// USAGE:
// https://api.keeskemper.nl/<key>/poi/create/<user_id>/<poi_name>/<poi_address>/<poi_longitude>/<poi_latitude>/<category_id>

// http://localhost:8080/getpoi/userid/category/longitude/latitude


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
$user_id = $URL[3];
$name = $URL[4];
$address = $URL[5];
$longitude = $URL[6];
$latitude = $URL[7];
$category_id = $URL[8];

$stmt = $poi->create($user_id, $name, $address, $longitude, $latitude, $category_id);


$num = $stmt->rowCount();

// check if more than 0 record found
if ($num > 0) {

        // set response code - 200 OK
    http_response_code(200);

    // show poi data in json format
    echo json_encode(
        array("message" => "Point of Interest created.")
    );
} else {
    // set response code - 404 Not found
    http_response_code(404);

    // tell the user no poi found
    echo json_encode(
        array("message" => "No Points of Interest created.")
    );
}
  
// no poi's found will be here