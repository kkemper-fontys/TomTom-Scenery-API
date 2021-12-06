<?php
class Cat_User
{

    // database connection and table name
    private $conn;
    private $table_name = "categories_user";

    // object properties
    public $categories_id;
    public $user_id;
    public $timestamp;
    public $counter;

    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // read products
    // function read()
    // {
    //     // select all query
    //     $query = "SELECT * FROM `user` WHERE 1 ORDER BY `id` ASC";

    //     // prepare query statement
    //     $stmt = $this->conn->prepare($query);

    //     // execute query
    //     $stmt->execute();

    //     return $stmt;
    // }

    function create($user_id, $categories_id_list, $counter=0)
    {
        $categories = explode(",", $categories_id_list);
        foreach($categories as $category){

            // insert query
            $query = "INSERT INTO `categories_user` (`categories_id`,`user_id`,`timestamp`,`counter`) VALUES (".$category.",".$user_id.",".time().",".$counter.")";

            // prepare query statement
            $stmt = $this->conn->prepare($query);

            // execute query
            $stmt->execute();
            // print_r($stmt);
        }
    }

    function update($device_id, $category_id)
    {
        // insert query
        $query = "UPDATE `categories_user` SET `counter`=counter+1 WHERE `user_id`=31 AND `categories_id`=".$category_id."";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();
        // print_r($stmt);
        return $stmt;
    }
}
