<?php
// USAGE:
// https://api.keeskemper.nl/<key>/create/user/<device_id>/categories/<category_list>

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/database.php';
include_once '../objects/user.php';
include_once '../objects/categories_user.php';

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// initialize object
$user = new User($db);
$cat_user = new Cat_User($db);

// read deviceinfo will be here
// query deviceinfo
$URL_DATA = $_SERVER['REQUEST_URI'];
$URL = explode("/", substr($URL_DATA, 1));

$device_id = $URL[3];
$category_list = $URL[5];
$stmt = $user->create($device_id);

// get the id stored in the database
$stmt2 = $user->readByDeviceId($device_id);
$row = $stmt2->fetch(PDO::FETCH_ASSOC);

$stmt3 = $cat_user->create($row['id'], $category_list);

// $num = $stmt->rowCount();

// if($num > 0){
//     // insert achieved - statuscode 200
//     http_response_code(200);
    
//     // tell the user everything worked
//     echo json_encode(
//         array("message" => "Device added")
//     ); 
// } else {
//     // set response code - 404 Not found
//     http_response_code(404);

//     // tell the user no products found
//     echo json_encode(
//         array("message" => "No products found.")
//     );  
// }