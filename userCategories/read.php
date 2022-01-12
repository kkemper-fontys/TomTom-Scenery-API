<?php
// USAGE:
// https://api.keeskemper.nl/<key>/readUserCategories/<user_id>

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/database.php';
include_once '../objects/categories_user.php';
include_once '../objects/categories.php';


// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// initialize object
$cat_user = new Cat_User($db);

// read categories will be here
// query categories
$URL_DATA = $_SERVER['REQUEST_URI'];
$URL = explode("/", substr($URL_DATA, 1));
$user_id = $URL[2];

$stmt = $cat_user->read($user_id);

$num = $stmt->rowCount();

// check if more than 0 record found
if ($num > 0) {

    // categpry array
    $cat_array = array();
    $cat_array["categories"] = array();
    
    // retrieve our table contents
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // extract row
        extract($row);

            $category = new Category($db);
            $stmt2 = $category->getCategoryById($row['categories_id']);
            $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
            
            extract($row2);

            $cat_item = array(
                "id" => $id,
                "categories_id" => $categories_id,
                "category" => $row2['nl_nl'],
                "user_id" => $user_id,
                "counter" => $counter
            );
        array_push($cat_array["categories"], $cat_item);
    }

    // set response code - 200 OK
    http_response_code(200);

    // show categories data in json format
    echo json_encode($cat_array);

} else {
    // set response code - 404 Not found
    http_response_code(404);

    // tell the user no usercategories found
    echo json_encode(
        array("message" => "No user categories found.")
    );
}
  
// no categories found will be here