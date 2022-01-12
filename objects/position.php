<?php
class Position
{

    // database connection and table name
    private $conn;
    private $table_name = "position_user";

    // object properties
    public $id;
    public $longitude;
    public $latitude;
    public $timestamp;

    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    function getByTimeStamp($timestamp)
    {
        // select all query
        $query = "SELECT * FROM `position_user` WHERE `timestamp`=".$timestamp." LIMIT 1";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    function read($input_longitude, $input_latitude, $timestamp)
    {
        // read query
        $query = "SELECT * FROM `position_user` WHERE `timestamp`=".$timestamp." AND `longitude`=".$input_longitude." AND `latitude`=".$input_latitude."";
        
        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    function create($input_longitude, $input_latitude, $timestamp)
    {
        $query = "INSERT INTO `position_user` (`longitude`, `latitude`, `timestamp`) VALUES ('".$input_longitude."','".$input_latitude."',".$timestamp.")";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }
}
