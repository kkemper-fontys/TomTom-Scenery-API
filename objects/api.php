<?php
class Api
{

    // database connection and table name
    private $conn;
    private $table_name = "api_calls";

    // object properties
    public $id;
    public $timestamp;
    public $call;

    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    function read($api_call, $timestamp)
    {
        // read query
        $query = "SELECT * FROM `api_calls` WHERE `timestamp`=".$timestamp." AND `call`='".$api_call."'";
        
        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    function create($api_call, $timestamp)
    {
        // insert query
        $query = "INSERT INTO `api_calls` (`timestamp`,`call`,`IP`) VALUES (".$timestamp.",'".$api_call."','".$_SERVER['REMOTE_ADDR']."')";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }
}
