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

    function create($input_longitude, $input_latitude, $timestamp)
    {

        // $pos = new Position($db);

        // query products
        //$stmt2 = $pos->getByTimeStamp($timestamp);
        //$num = $stmt2->rowCount();
        // insert query
        //if($num == 0){
            $query = "INSERT INTO `position_user` (`longitude`, `latitude`, `timestamp`) VALUES ('".$input_longitude."','".$input_latitude."',".$timestamp.")";
        //}

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }
}
