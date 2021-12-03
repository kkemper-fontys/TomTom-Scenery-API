<?php
class Category
{

    // database connection and table name
    private $conn;
    private $table_name = "categories";

    // object properties
    public $id;
    public $name;
    public $tomtom_id;
    public $synonyms;

    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // read products
    function read($sub = false, $IDs = null)
    {

        // select all query
        if ($sub) {
            if ($IDs != "") {
                $query = "SELECT * FROM `categories` WHERE `parent_id`!=0 AND `parent_id` in (" . $IDs . ") ORDER BY `nl_nl` ASC";
            } else {
                $query = "SELECT * FROM `categories` WHERE `parent_id`!=0 ORDER BY `nl_nl` ASC";
            }
        } else {
            $query = "SELECT * FROM `categories` WHERE `parent_id`=0 ORDER BY `nl_nl` ASC";
        }

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }
}
