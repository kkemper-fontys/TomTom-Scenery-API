<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/database.php';
include_once '../objects/categories_user.php';
include_once '../objects/user.php';


// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// initialize object
$cat_user = new Cat_User($db);

// read products will be here
// query products
$URL_DATA = $_SERVER['REQUEST_URI'];
$URL = explode("/", substr($URL_DATA, 1));
$DEVICE_ID = $URL[2];
$category_id = $URL[3];

$stmt = $cat_user->update($DEVICE_ID, $category_id);

$num = $stmt->rowCount();

// check if more than 0 record found
if ($num > 0) {

    // set response code - 200 OK
    http_response_code(200);

    // show products data in json format
    echo json_encode(
        array("message" => "Category updated!")
    );
} else {
    $user = new User($db);
    
    // get the id stored in the database
    $stmt2 = $user->readByDeviceId($DEVICE_ID);
    $row = $stmt2->fetch(PDO::FETCH_ASSOC);

    $stmt3 = $cat_user->create($row['id'], $category_id, 1);
    
    // set response code - 200 OK
    http_response_code(200);

    // show products data in json format
    echo json_encode(
        array("message" => "Category updated!")
    );
}
  
// no products found will be here