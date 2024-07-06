<?php
// config.php
//THIS IS THE CODE THAT HANDLES DATABASE CONFIGURATION
//ON ALL YOUR PAGES write this line (include 'inc/config.php';) 
//ENJOY!!!$servername = "localhost";

$servername = "localhost";
$username = "root";
$password = "rehanais2cool";
$dbname = "recipes";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
/*
define('DB_HOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'rehanais2cool');
define('DB_NAME', 'recipes');



$conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($conn->connect_error) {
    die("Connection failed: ". $conn->connect_error);
}*/
?>