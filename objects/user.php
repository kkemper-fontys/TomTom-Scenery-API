<?php
class User
{

    // database connection and table name
    private $conn;
    private $table_name = "user";

    // object properties
    public $id;
    public $device_id;
    public $longitude;
    public $latitude;
    public $last_updated;

    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // read products
    function readByDeviceId($device_id)
    {
        // select all query
        $query = "SELECT * FROM `user` WHERE `device_id`='".$device_id."' LIMIT 1";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    function create($input_deviceid)
    {
        // insert query
        $query = "INSERT INTO `user` (`device_id`) VALUES ('".$input_deviceid."')";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    function updateByDeviceId($input_device_id, $input_longitude, $input_latitude)
    {
        $query = "UPDATE `user` SET `longitude`='".$input_longitude."', `latitude`='".$input_latitude."', `last_updated`=".time()." WHERE `device_id`='".$input_device_id."'";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    function getAllUsers(){

        $query = "SELECT * FROM `user` WHERE `last_updated`>".(time()-5000)." ORDER BY `last_updated` ASC";

        // $query = "SELECT * FROM `user` WHERE 1 ORDER BY `last_updated` DESC";
        
        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }
}
