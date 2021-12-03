<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/database.php';
include_once '../objects/api.php';

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// initialize object
$api = new Api($db);

// read deviceinfo will be here
// query deviceinfo
$URL_DATA = $_SERVER['REQUEST_URI'];

$stmt = $api->create($URL_DATA);
