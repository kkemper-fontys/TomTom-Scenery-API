<?php
// USAGE:
// https://api.keeskemper.nl/<key>/users/readall

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

$stmt = $user->getAllUsers();

$num = $stmt->rowCount();

// check if more than 0 record found
if ($num > 0) {

    // products array
    $user_array = array();
    $user_array["users"] = array();
    

    // retrieve our table contents
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // extract row
        extract($row);

            // $category = new Category($db);
            // $catdata = $category->getCategoryById($row['category_id']);
            // $row2 = $catdata->fetch(PDO::FETCH_ASSOC);
            
            // $cat_row = extract($fetchedCategory);

            $user_item = array(
                "id" => $id,
                "device_id" => $device_id,
                "longitude" => $longitude,
                "latitude" => $latitude,
                "last_updated" => $last_updated
            );

        array_push($user_array["users"], $user_item);
    }

    // set response code - 200 OK
    http_response_code(200);

    // show poi data in json format
    echo json_encode($user_array);
} else {
    // set response code - 404 Not found
    http_response_code(404);

    // tell the user no poi found
    echo json_encode(
        array("message" => "No users found.")
    );
}
  
// no poi's found will be here