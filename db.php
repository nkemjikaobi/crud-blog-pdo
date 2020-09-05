<?php

$host = 'localhost';
$username = 'root';
$password = '';
$database  = 'blog-pdo';

// $host = 'us-cdbr-east-02.cleardb.com';
// $username = 'b697b23a2fead0';
// $password = '6bf94e9c';
// $database  = 'heroku_fcb8f6dcd1a86ce';


$conn = new mysqli($host,$username, $password,$database);

if(!$conn){
    die("Database Connection Error");
}

$sql = "CREATE TABLE posts (
    id int(255) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    title varchar(255) NOT NULL,
    body varchar(255) NOT NULL,
    author varchar(255) NOT NULL,
    image blob NOT NULL,
    time timestamp DEFAULT CURRENT_TIMESTAMP
)";


if ($conn->query($sql) === TRUE) {
  echo "Table MyGuests created successfully";
} else {
  echo "Error creating table: " . $conn->error;
}

$conn->close();



/*
mysql://b697b23a2fead0:6bf94e9c@us-cdbr-east-02.cleardb.com/heroku_fcb8f6dcd1a86ce?reconnect=true
*/
?>