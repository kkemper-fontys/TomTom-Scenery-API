<?php
class Poi
{

    // database connection and table name
    private $conn;
    private $table_name = "poi_user";

    // object properties
    public $id;
    public $user_id;
    public $name;
    public $address;
    public $longitude;
    public $latitude;
    public $category_id;
    public $timestamp;

    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // read products
    function read($DEVICE_ID, $timestamp)
    {
        
        $query = "SELECT * FROM `poi_user` WHERE `user_id`=(SELECT `id` FROM `user` WHERE `device_id`='".$DEVICE_ID."') AND `timestamp`>=".($timestamp - 1000)." ORDER BY `timestamp` DESC LIMIT 5";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }
}
