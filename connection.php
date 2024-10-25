<?php
// Database connection variables
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "my_social"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected";
