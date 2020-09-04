<?php

$host = 'localhost';
$username = 'root';
$password = '';
$database  = 'blog-pdo';


$conn = new mysqli($host,$username, $password,$database);

if(!$conn){
    die("Database Connection Error");
}

?>