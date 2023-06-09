<?php
class Database{
    private $connection;
    function __construct(){
        $this->connect_db(); // -> referencing the function
    }

    // connect to mysql
    public function connect_db(){
        $this->connection = mysqli_connect('172.31.22.43', 'Seahee200530585', 'isuvIFGUxI', 'Seahee200530585');
        if(mysqli_connect_error()){
            die("Database is dead" . mysqli_connect_error() . mysqli_connect_error());
        }
    }
    public function create($pizza,$fname,$lname,$phonenum,$email,$address){
        $sql = "INSERT INTO pizzaOrder(pizza, fname, lname, phonenum, email, address) VALUES ('$pizza', '$fname', '$lname', '$phonenum', '$email', '$address')";
        $res = mysqli_query($this->connection,$sql);
        if ($res) {
            return true;
        }else{
            return false;
        }
    }
    public function read($id=null){
        $sql = "SELECT * FROM pizzaOrder"; // Select all from pizzaOrder database to show
        if($id){
            $sql .= " WHERE id=$id";
        }
        $res = mysqli_query($this->connection, $sql);
        return $res;
    }
    public function sanitize($var){
        $return = mysqli_real_escape_string($this->connection,$var); // return
        return $return;
    }
}
$database = new Database();