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

    function create($api_call)
    {
        // insert query
        $query = "INSERT INTO `api_calls` (`timestamp`,`call`) VALUES (".time().",'".$api_call."')";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }
}
