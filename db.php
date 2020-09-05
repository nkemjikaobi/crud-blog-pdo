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
/*
mysql://b697b23a2fead0:6bf94e9c@us-cdbr-east-02.cleardb.com/heroku_fcb8f6dcd1a86ce?reconnect=true
*/
?>