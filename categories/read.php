<?php
// USAGE:
// https://api.keeskemper.nl/<key>/search/(sub)categories/<category_list>

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/database.php';
include_once '../objects/categories.php';

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// initialize object
$category = new Category($db);

// read products will be here
// query products
$URL_DATA = $_SERVER['REQUEST_URI'];
$URL = explode("/", substr($URL_DATA, 1));
$SEARCH_TYPE = $URL[2];

if ($SEARCH_TYPE === "subcategories") {
    $IDs = $URL[3];
    $stmt = $category->read(true, $IDs);
} else {
    $stmt = $category->read();
}
$num = $stmt->rowCount();

// check if more than 0 record found
if ($num > 0) {

    // products array
    $category_arr = array();
    $category_arr["categories"] = array();

    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);

        if ($row['parent_id'] > 0) {
            $category_item = array(
                "id" => $id,
                "tomtom_id" => $tomtom_id,
                "parentID" => $parentID,
                "nl_nl" => $nl_nl,
                "en_gb" => $en_gb,
                "image_url" => $image_url
            );
        } else {
            $category_item = array(
                "id" => $id,
                "tomtom_id" => $tomtom_id,
                "nl_nl" => $nl_nl,
                "en_gb" => $en_gb,
                "image_url" => $image_url
            );
        }

        array_push($category_arr["categories"], $category_item);
    }

    // set response code - 200 OK
    http_response_code(200);

    // show products data in json format
    echo json_encode($category_arr);
} else {
    // set response code - 404 Not found
    http_response_code(404);

    // tell the user no products found
    echo json_encode(
        array("message" => "No products found.")
    );
}
  
// no products found will be here